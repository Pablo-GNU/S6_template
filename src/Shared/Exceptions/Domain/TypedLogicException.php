<?php

declare(strict_types=1);

namespace Code\Shared\Exceptions\Domain;

use LogicException;
use Throwable;

abstract class TypedLogicException extends LogicException
{
    private $additionalData;

    public function __construct(?array $additionalData = null, ?Throwable $previous = null)
    {
        parent::__construct('', 0, $previous);
        $this->additionalData = $additionalData;
    }

    public function additionalData(): ?array
    {
        return $this->additionalData;
    }

    abstract public function exceptionType(): string;
}
