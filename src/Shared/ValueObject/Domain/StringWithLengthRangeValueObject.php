<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

use Code\Shared\Exceptions\Domain\DomainErrorException;

abstract class StringWithLengthRangeValueObject extends StringValueObject
{
    protected const MIN_LENGTH = 0;
    protected const MAX_LENGTH = 250;

    public function __construct(string $value)
    {
        $this->ensureExceedsMinLength($value);
        $this->ensureNotExceedsMaxLength($value);
        parent::__construct($value);
    }

    protected function ensureExceedsMinLength(string $value): void
    {
        if (\mb_strlen($value) >= static::MIN_LENGTH) {
            return;
        }

        $this->notExceedsMinLengthException();
    }

    protected function ensureNotExceedsMaxLength(string $value): void
    {
        if (\mb_strlen($value) <= static::MAX_LENGTH) {
            return;
        }

        $this->exceedsMaxLengthException();
    }

    protected function notExceedsMinLengthException(): void
    {
        throw new DomainErrorException(
            \sprintf('The min length is %1', ['%1' => static::MIN_LENGTH])
        );
    }

    protected function exceedsMaxLengthException(): void
    {
        throw new DomainErrorException(
            \sprintf('The max length is %1', ['%1' => static::MAX_LENGTH])
        );
    }
}
