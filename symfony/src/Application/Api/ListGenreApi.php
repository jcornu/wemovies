<?php

declare(strict_types=1);

namespace App\Application\Api;

use App\Domain\Input\SearchQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListGenreApi
{
    #[Route('/api/genres', name: 'api_genres')]
    public function execute(): Response
    {
        $movies = $this->listMovies->execute(new SearchQuery('test', 1));

        return new JsonResponse(['items' => $movies]);
    }
}
