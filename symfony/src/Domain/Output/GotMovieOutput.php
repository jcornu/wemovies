<?php

declare(strict_types=1);

namespace App\Domain\Output;

use App\Domain\Movie;

class GotMovieOutput
{
    public function __construct(
        public readonly Movie $movie
    ) {
    }
}
