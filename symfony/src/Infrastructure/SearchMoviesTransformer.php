<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Output\SearchedMovieOutput;
use App\Domain\Output\SearchedMovieOutputCollection;

class SearchMoviesTransformer
{
    public function transform(array $movies): SearchedMovieOutputCollection
    {
        $views = [];

        foreach ($movies as $movie) {
            $views[] = new SearchedMovieOutput(
                $movie['title'],
                $movie['overview'],
                $movie['poster_path'],
                new \DateTimeImmutable($movie['release_date']),
                $movie['id'],
                $movie['genre_ids'],
                $movie['vote_count'],
                $movie['vote_average'],
            );
        }

        return new SearchedMovieOutputCollection($views);
    }
}
