<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain\Exceptions;

use Code\Shared\Exceptions\Domain\TypedLogicException;

final class PositiveIntWithoutZeroMinValueNotExceeded extends TypedLogicException
{
    public function exceptionType(): string
    {
        return 'positive_int_without_zero_min_value_not_exceeded';
    }
}
