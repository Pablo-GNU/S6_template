<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Domain;

use Code\Shared\ValueObject\Domain\StringWithLengthRangeValueObject;

final class ExampleSurname extends StringWithLengthRangeValueObject
{
    protected const MIN_LENGTH = 0;
    protected const MAX_LENGTH = 100;
}
