<?php

declare(strict_types=1);

namespace Presentation\Resource;

class GetMovieResource
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $imageUrl,
        public readonly string $releasedYear,
        public readonly int $id,
        public readonly array $genres,
        public readonly int $voteCount,
        public readonly int $numberOfStars,
        public readonly ?string $productionCompanyName,
        public readonly ?string $videoUrl,
    ) {
    }
}
