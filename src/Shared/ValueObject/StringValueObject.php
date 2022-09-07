<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject;

use DomainException;

abstract class StringValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

}