<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain\Exceptions;

use Code\Shared\Exceptions\Domain\TypedLogicException;

final class PositiveIntMinValueNotExceeded extends TypedLogicException
{
    public function exceptionType(): string
    {
        return 'positive_int_min_value_not_exceeded';
    }
}
