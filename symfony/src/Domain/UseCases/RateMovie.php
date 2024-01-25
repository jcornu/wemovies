<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Gateway\MovieRepository;
use App\Domain\Input\RateMovieInput;
use App\Domain\Output\GotMovieOutput;

class RateMovie
{
    public function __construct(
        private readonly MovieRepository $movieRepository
    )
    {
    }

    public function execute(RateMovieInput $input): GotMovieOutput
    {
        $movie = $this->movieRepository->get($input->movieId);

        $movie->rate($input->rating);

        $this->movieRepository->rate($movie);

        return new GotMovieOutput($movie);
    }
}
