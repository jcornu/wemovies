<?php

declare(strict_types=1);


namespace App\Tests\Application;

use App\Infrastructure\TMDBClient;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SearchMoviesTest extends WebTestCase
{
    /**
     * @test
     */
    public function searchApiShouldReturnExpectedMovies(): void
    {
        $client = static::createClient();
        $this->mockTMDBClient($client);

        $client->request('GET', '/api/movies/search', ['search' => 'test'], [], [], 'application/json');

        $response = $client->getResponse();
        $payload = \json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        self::assertEquals(200, $response->getStatusCode());
        self::assertCount(16, $payload['items']);
        self::assertSame([
            'title' => 'Wonka',
            'description' => 'Willy Wonka – chock-full of ideas and determined to change the world one delectable bite at a time – is proof that the best things in life begin with a dream, and if you’re lucky enough to meet Willy Wonka, anything is possible.',
            'imageUrl' => 'https://image.tmdb.org/t/p/w500//qhb1qOilapbapxWQn9jtRCMwXJF.jpg',
            'releaseDate' => '2023-12-06',
            'id' => 787699,
        ], $payload['items'][0]);
    }

    private function mockTMDBClient(KernelBrowser $client, array $data = []): void
    {
        $data = [];
        $mockClient = new MockHttpClient(
            new MockResponse($data),
            'http://tmdb.local'
        );
        $tmdbClient = new TMDBClient($mockClient);
        $client->getContainer()->set('StubTMDBClient', $tmdbClient);
    }

}
