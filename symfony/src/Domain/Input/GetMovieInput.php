<?php

declare(strict_types=1);

namespace App\Domain\Input;

use App\Domain\MovieId;

class GetMovieInput
{
    public function __construct(
        public readonly MovieId $movieId
    ) {
    }
}
