<?php

declare(strict_types=1);

namespace Code\Shared\Exceptions\Domain;

use DomainException;
use Throwable;

class DomainErrorException extends DomainException
{
    private $customData;

    public function __construct(string $message, array $customData = [], int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->customData = $customData;
    }

    public function errorCode(): string
    {
        return 'domain_error';
    }

    public function customData(): array
    {
        return $this->customData;
    }
}
