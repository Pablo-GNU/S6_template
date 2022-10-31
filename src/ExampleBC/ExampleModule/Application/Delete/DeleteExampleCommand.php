<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Delete;

use Code\Shared\Bus\Command\Domain\Command;

final class DeleteExampleCommand implements Command
{
    public function __construct(private readonly string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
