<?php

declare(strict_types=1);

namespace App\Domain\Input;

final class SearchQuery
{
    public function __construct(
        public readonly string $search,
        public readonly ?array $genreIds = [],
        public readonly ?int $page = 1
    ){
    }

    public function hasGenreIds(): bool
    {
        dump($this->genreIds);
        return !empty($this->genreIds);
    }
}
