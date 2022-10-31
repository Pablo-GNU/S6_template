<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Create;

use Code\Shared\Bus\Command\Domain\Command;

final class CreateExampleCommand implements Command
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $surname,
        private readonly int $age
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function age(): int
    {
        return $this->age;
    }
}
