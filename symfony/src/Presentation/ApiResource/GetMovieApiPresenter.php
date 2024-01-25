<?php

declare(strict_types=1);

namespace Presentation\Resource;

use App\Domain\Output\GotMovieOutput;

class GetMovieApiPresenter
{
    private const IMAGE_BASE_URL = 'https://image.tmdb.org/t/p/w500';

    public function present(GotMovieOutput $output): GetMovieResource
    {
        $movie = $output->movie;

        return new GetMovieResource(
            $movie->title,
            $movie->description,
            $movie->imageUrl ? self::IMAGE_BASE_URL . '/' . $movie->imageUrl : null,
            $movie->releasedYear->format('Y'),
            $movie->id->toInt(),
            $movie->genres,
            $movie->voteCount,
            (int) round($movie->rating / 2),
            $movie->getCompanyName(),
            $movie->getVideoUrl(),
        );
    }
}
