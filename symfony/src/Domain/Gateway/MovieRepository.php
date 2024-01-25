<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Input\SearchQuery;
use App\Domain\Movie;
use App\Domain\MovieId;
use App\Domain\Output\SearchedMovieOutputCollection;

interface MovieRepository
{
    public function search(SearchQuery $query): SearchedMovieOutputCollection;

    public function get(MovieId $movieId): Movie;

    public function rate(Movie $movie): void;
}
