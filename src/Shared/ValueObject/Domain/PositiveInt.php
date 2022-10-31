<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

use Code\Shared\ValueObject\Domain\Exceptions\PositiveIntMinValueNotExceeded;

class PositiveInt extends IntValueObject
{
    protected const MIN_VALUE = 0;

    public function __construct(int $value)
    {
        $this->ensureExceedsMinValue($value);
        parent::__construct($value);
    }

    protected function ensureExceedsMinValue(int $value): void
    {
        if ($value >= static::MIN_VALUE) {
            return;
        }

        $this->notExceedsMinValueException();
    }

    protected function notExceedsMinValueException(): void
    {
        throw new PositiveIntMinValueNotExceeded(['%1' => static::MIN_VALUE]);
    }
}
