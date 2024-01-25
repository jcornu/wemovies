<?php

declare(strict_types=1);

namespace App\Domain\Output;

final class ListedGenreOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ) {
    }
}
