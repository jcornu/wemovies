<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Gateway\GenreRepository as GenreRepositoryInterface;
use App\Domain\Output\ListedGenreOutput;

class GenreRepository implements GenreRepositoryInterface
{
    private TMDBClient $client;

    public function __construct(TMDBClient $client)
    {
        $this->client = $client;
    }


    /** @return ListedGenreOutput[] */
    public function list(): array
    {
        $results = $this->client->listGenres();

        $views = [];
        foreach ($results as $result) {
            $views[] = new ListedGenreOutput(
                $result['id'],
                $result['name']
            );
        }

        return $views;
    }
}
