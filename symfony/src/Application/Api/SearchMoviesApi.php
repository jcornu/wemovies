<?php

declare(strict_types=1);

namespace App\Application\Api;

use App\Domain\Input\GetMovieInput;
use App\Domain\Input\SearchQuery;
use App\Domain\MovieId;
use App\Domain\UseCases\GetMovie;
use App\Domain\UseCases\SearchMovies;
use Presentation\Resource\SearchMovieApiPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchMoviesApi
{
    private SearchMovies $searchMovies;
    private GetMovie $getMovie;

    public function __construct(
        SearchMovies $searchMovies,
        GetMovie $getMovie
    ) {
        $this->searchMovies = $searchMovies;
        $this->getMovie = $getMovie;
    }

    #[Route('/api/movies/search', name: 'api_movie_search')]
    public function execute(Request $request): Response
    {
        $search = $request->query->get('search');
        $genreIds = $request->query->get('genreIds');

        if (null !== $genreIds) {
            $genreIds = \explode(',', $genreIds);
        }

        $moviesCollection = $this->searchMovies->execute(new SearchQuery($search, $genreIds));

        // for API rate limit issue, limit to 3 first calls
        $gotMovies = [];
        foreach ($moviesCollection->getThreeFirstResults() as $movie) {
            $gotMovies[$movie->id] = $this->getMovie->execute(new GetMovieInput(
                MovieId::fromInt($movie->id)
            ));
        }


        // compose UI via presenter
        $presenter = new SearchMovieApiPresenter();

        return new JsonResponse($presenter->present($moviesCollection, $gotMovies));
    }
}
