<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Domain\Exceptions;

use Code\Shared\Exceptions\Domain\TypedLogicException;

final class ExampleNotExist extends TypedLogicException
{
    public function exceptionType(): string
    {
        return 'example_not_exist';
    }
}
