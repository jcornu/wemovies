<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Gateway\MovieRepository;
use App\Domain\Input\GetMovieInput;
use App\Domain\Output\GotMovieOutput;

class GetMovie
{
    public function __construct(
        private readonly MovieRepository $movieRepository
    )
    {
    }

    public function execute(GetMovieInput $input): GotMovieOutput
    {
        $movie = $this->movieRepository->get($input->movieId);

        return new GotMovieOutput($movie);
    }
}
