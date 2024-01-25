<?php

declare(strict_types=1);

namespace App\Domain\Output;

class SearchedMovieOutputCollection
{
    /**
     * @param SearchedMovieOutput[] $movies
     */
    private array $movies;

    public function __construct(array $movies)
    {
        $this->movies = $movies;
    }

    public function orderByRating(): self
    {
        $sortedMovies = $this->movies;

        usort($sortedMovies, static function (SearchedMovieOutput $a, SearchedMovieOutput $b) {
            return $b->rating <=> $a->rating;
        });

        return new self($sortedMovies);
    }

    public function movies(): array
    {
        return $this->movies;
    }

    /**
     * @return SearchedMovieOutput[]
     */
    public function getThreeFirstResults(): array
    {
        return array_slice($this->movies, 0, 3);
    }
}
