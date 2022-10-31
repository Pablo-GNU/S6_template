<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Domain;

use Code\Shared\Aggregate\Domain\AggregateRoot;

final class Example extends AggregateRoot
{
    public function __construct(
        private readonly ExampleId $id,
        private readonly ExampleName $name,
        private readonly ExampleSurname $surname,
        private readonly ExampleAge $age
    ) {
    }

    public static function fromPrimitives(
        string $id,
        string $name,
        string $surname,
        int $age
    ): self {
        return new self(
            new ExampleId($id),
            new ExampleName($name),
            new ExampleSurname($surname),
            new ExampleAge($age)
        );
    }

    public function id(): ExampleId
    {
        return $this->id;
    }

    public function name(): ExampleName
    {
        return $this->name;
    }

    public function surname(): ExampleSurname
    {
        return $this->surname;
    }

    public function age(): ExampleAge
    {
        return $this->age;
    }

    public function update(
        ExampleName $name,
        ExampleSurname $surname,
        ExampleAge $age
    ): self {
        return new self(
            $this->id,
            $name,
            $surname,
            $age
        );
    }
}
