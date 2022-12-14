<?php

declare(strict_types=1);

namespace Code\Shared\ValueObject\Domain;

use Code\Shared\Exceptions\Domain\DomainErrorException;

abstract class IntPositiveValueObject
{
    private readonly int $id;

    public function __construct(int $id)
    {
        if ($id <= 0) {
            throw new DomainErrorException('The ID must be greater than 0');
        }

        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }
}
