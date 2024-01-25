<?php

declare(strict_types=1);

namespace App\Domain;

class MovieVideo
{
    public function __construct(
        public readonly ?string $videoId,
        public readonly ?string $videoName,
        public readonly ?string $videoKey,
        public readonly ?string $videoSite,
    ) {
    }
}
