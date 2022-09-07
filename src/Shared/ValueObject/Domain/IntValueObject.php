<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

abstract class IntValueObject
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }
}