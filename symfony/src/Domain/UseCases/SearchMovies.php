<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Gateway\MovieRepository;
use App\Domain\Input\SearchQuery;
use App\Domain\Output\SearchedMovieOutputCollection;

class SearchMovies
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function execute(SearchQuery $searchQuery): SearchedMovieOutputCollection
    {
        $movies = $this->movieRepository->search($searchQuery);

        return $movies->orderByRating();
    }
}
