<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Gateway\GenreRepository;
use App\Domain\Output\ListedGenreOutput;

class ListGenres
{

    public function __construct(
        private GenreRepository $genreRepository
    )
    {
    }

    /** @return ListedGenreOutput[] */
    public function execute(): array
    {
        return $this->genreRepository->list();
    }
}
