<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Movie;
use App\Domain\MovieId;
use App\Domain\MovieProductionCompany;
use App\Domain\MovieVideo;

class MovieTransformer
{
    public function transform(array $result): Movie
    {
        $video = $result['videos']['results'][0] ?? null;
        $movieVideo = $video === null ? null : new MovieVideo(
            $video['id'] ?? null,
            $video['name'] ?? null,
            $video['key'] ?? null,
            $video['site'] ?? null,
        );

        $defaultCompany = $result['production_companies'][0] ?? null;
        $productionCompany = $defaultCompany === null ? null : new MovieProductionCompany(
                $defaultCompany['id'],
                $defaultCompany['name'],
                $defaultCompany['logo_path'],
            );

        return new Movie(
            $result['title'],
            $result['overview'],
            $result['poster_path'],
            new \DateTimeImmutable($result['release_date']),
            $productionCompany,
            MovieId::fromInt($result['id']),
            $result['genres'],
            $result['vote_count'],
            $result['vote_average'],
            $movieVideo
        );
    }
}
