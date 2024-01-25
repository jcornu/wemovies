<?php

declare(strict_types=1);

namespace Presentation\Resource;

use App\Domain\Output\GotMovieOutput;
use App\Domain\Output\SearchedMovieOutputCollection;

class SearchMovieApiPresenter
{
    private const IMAGE_BASE_URL = 'https://image.tmdb.org/t/p/w500';

    /**
     * @param SearchedMovieOutputCollection $moviesCollection
     * @param GotMovieOutput[] $gotMovieOutputs
     *
     * @return SearchMovieResource[]
     */
    public function present(SearchedMovieOutputCollection $moviesCollection, array $gotMovieOutputs): array
    {
        $resources = [];
        foreach ($moviesCollection->movies() as $movie) {
            $companyName = $videoUrl = null;
            if (isset($gotMovieOutputs[$movie->id])) {
                $companyName = $gotMovieOutputs[$movie->id]->movie->getCompanyName();
            }

            if (isset($gotMovieOutputs[$movie->id])) {
                $videoUrl = $gotMovieOutputs[$movie->id]->movie->getVideoUrl();
            }

            $resources[] = new SearchMovieResource(
                $movie->title,
                $movie->description,
                $movie->imageUrl ? self::IMAGE_BASE_URL . '/' . $movie->imageUrl : null,
                $movie->releasedYear->format('Y'),
                $movie->id,
                $movie->genres,
                $movie->voteCount,
                (int) round($movie->rating / 2),
                $companyName,
                $videoUrl,
            );
        }

        return ['items' => $resources];
    }
}
