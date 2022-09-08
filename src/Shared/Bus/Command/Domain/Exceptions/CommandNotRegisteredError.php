<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Command\Domain\Exceptions;

use Code\Shared\Bus\Command\Domain\Command;
use RuntimeException;

final class CommandNotRegisteredError extends RuntimeException
{
    public function __construct(Command $query)
    {
        $commandClass = $query::class;

        parent::__construct('The command ' . $commandClass . " hasn't a command handler associated");
    }
}
