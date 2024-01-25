<?php

declare(strict_types=1);

namespace App\Domain\Input;

use App\Domain\MovieId;

class RateMovieInput
{
    public function __construct(
        public readonly MovieId $movieId,
        public int $rating
    ) {
    }
}
