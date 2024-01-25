<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\MovieId;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TMDBClient
{
    private HttpClientInterface $tmdbClient;
    private const API_URL_PREFIX = '/3';
    public function __construct(HttpClientInterface $tmdbClient)
    {
        $this->tmdbClient = $tmdbClient;
    }

    public function searchMovie(string $query, int $page = 1): array
    {
        $url = sprintf('%s/search/movie?query=%s&language=%s&page=%d',
            self::API_URL_PREFIX,
            $query,
            'fr-FR',
            $page
        );

        $response = $this->tmdbClient->request('GET', $url);

        return $response->toArray()['results'];
    }

    public function getMovie(MovieId $movieId): array
    {
        $url = sprintf('%s/movie/%d?append_to_response=videos&language=%s',
            self::API_URL_PREFIX,
            $movieId->toInt(),
            'fr-FR'
        );

        $response = $this->tmdbClient->request('GET', $url);

        return $response->toArray();
    }

    public function listGenres(): array
    {
        $response = $this->tmdbClient->request('GET', self::API_URL_PREFIX . '/genre/movie/list?language=fr');

        return $response->toArray()['genres'];
    }

    public function rateMovie(MovieId $movieId, int $rating)
    {
        // TODO: call the API to rate the movie
    }
}
