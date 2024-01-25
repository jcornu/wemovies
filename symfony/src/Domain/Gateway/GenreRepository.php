<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Output\ListedGenreOutput;

interface GenreRepository
{
    /** @return ListedGenreOutput[] */
    public function list(): array;
}
