<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

use Code\Shared\ValueObject\Domain\Exceptions\PositiveIntWithoutZeroMinValueNotExceeded;

class PositiveIntWithoutZero extends PositiveInt
{
    protected const MIN_VALUE = 1;

    protected function notExceedsMinValueException(): void
    {
        throw new PositiveIntWithoutZeroMinValueNotExceeded(['%1' => static::MIN_VALUE]);
    }
}
