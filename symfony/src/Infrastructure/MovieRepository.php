<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\MovieRepository as MovieRepositoryInterface;
use App\Domain\Input\SearchQuery;
use App\Domain\Movie;
use App\Domain\MovieId;
use App\Domain\Output\SearchedMovieOutputCollection;

class MovieRepository implements MovieRepositoryInterface
{
    private const NB_MAX_API_CALL = 3;
    private TMDBClient $client;
    private SearchMoviesTransformer $searchTransformer;
    private MovieTransformer $movieTransformer;

    public function __construct(
        TMDBClient $client,
        SearchMoviesTransformer $searchTransformer,
        MovieTransformer $movieTransformer
    ) {
        $this->client = $client;
        $this->searchTransformer = $searchTransformer;
        $this->movieTransformer = $movieTransformer;
    }

    public function search(SearchQuery $query): SearchedMovieOutputCollection
    {
        $apiResults = $this->client->searchMovie($query->search, $query->page);

        if (false === $query->hasGenreIds()) {
            return $this->searchTransformer->transform($apiResults);
        }

        $filteredMovies = $this->filterMoviesByGenres($apiResults, $query);

        return $this->searchTransformer->transform($filteredMovies);
    }

    public function get(MovieId $movieId) : Movie
    {
        $result = $this->client->getMovie($movieId);

        return $this->movieTransformer->transform($result);
    }

    public function rate(Movie $movie): void
    {
        $this->client->rateMovie($movie->id, $movie->customRating());
    }


    /**
     * @param array $apiResults
     * @param SearchQuery $query
     *
     * @return array
     */
    private function filterMoviesByGenres(array $apiResults, SearchQuery $query): array
    {
        $nbApiCalls = 1;
        $filteredMovies = [];
        do {
            $subResults = \array_filter($apiResults, static function (array $movie) use ($query) {
                foreach ($query->genreIds as $genreId) {
                    if (true === \in_array($genreId, $movie['genre_ids'], false)) {
                        return true;
                    }
                }

                return false;
            });

            $filteredMovies = [...$filteredMovies, ...$subResults];
            $apiResults = $this->client->searchMovie($query->search, $query->page + $nbApiCalls);
            $nbApiCalls++;
        } while (count($filteredMovies) < 10 && $nbApiCalls <= self::NB_MAX_API_CALL);

        return $filteredMovies;
    }
}
