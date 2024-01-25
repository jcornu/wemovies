<?php

declare(strict_types=1);

namespace App\Domain;

class MovieId
{
    public function __construct(private readonly int $id)
    {
    }

    public static function fromInt(int $id): self
    {
        return new self($id);
    }

    public function toInt(): int
    {
        return $this->id;
    }
}
