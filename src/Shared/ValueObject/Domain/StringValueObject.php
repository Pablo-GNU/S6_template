<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

abstract class StringValueObject
{
    public function __construct(private readonly string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
