<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

abstract class IntValueObject
{
    public function __construct(private readonly int $id)
    {
    }

    public function value(): int
    {
        return $this->id;
    }
}