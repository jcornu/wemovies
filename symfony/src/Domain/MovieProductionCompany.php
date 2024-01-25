<?php

declare(strict_types=1);

namespace App\Domain;

class MovieProductionCompany
{
    public function __construct(
        public readonly int $companyId,
        public readonly string $companyName,
        public readonly ?string $companyLogoPath,
    ) {
    }
}
