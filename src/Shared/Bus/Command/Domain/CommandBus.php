<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Command\Domain;

interface CommandBus
{
    public function dispatch(Command $command): void;
}