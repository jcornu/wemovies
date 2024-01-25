<?php

declare(strict_types=1);

namespace App\Domain\Output;

final class SearchedMovieOutput
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $imageUrl,
        public \DateTimeImmutable $releasedYear,
        public readonly int $id,
        public readonly array $genres,
        public readonly int $voteCount,
        public readonly float $rating
    ) {
    }
}
