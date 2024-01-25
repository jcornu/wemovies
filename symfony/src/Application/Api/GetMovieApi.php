<?php

declare(strict_types=1);

namespace App\Application\Api;

use App\Domain\Input\GetMovieInput;
use App\Domain\MovieId;
use App\Domain\UseCases\GetMovie;
use Presentation\Resource\GetMovieApiPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetMovieApi
{

    public function __construct(
        private readonly GetMovie $getMovie
    )
    {
    }

    #[Route('/api/movies/{movieId}', name: 'api_movies_get_item', methods: ['GET'], requirements: ['movieId' => '\d+'])]
    public function execute(int $movieId): Response
    {
        $gotMovieOutput = $this->getMovie->execute(
            new GetMovieInput(MovieId::fromInt($movieId))
        );

        $presenter = new GetMovieApiPresenter();

        return new JsonResponse($presenter->present($gotMovieOutput));
    }
}
