<?php

declare(strict_types=1);

namespace App\Domain;

class Movie
{
    private ?int $customRating = null;
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $imageUrl,
        public \DateTimeImmutable $releasedYear,
        public readonly ?MovieProductionCompany $productionCompany,
        public readonly MovieId $id,
        public readonly array $genres,
        public readonly int $voteCount,
        public readonly float $rating,
        public readonly ?MovieVideo $video
    ) {
    }


    public function getCompanyName(): ?string
    {
        return $this->productionCompany?->companyName;
    }

    public function getVideoUrl(): ?string
    {
        return $this->video?->videoKey;
    }

    public function rate(int $rating): void
    {
        $this->customRating = $rating;
    }

    public function customRating(): ?int
    {
        return $this->customRating;
    }
}
