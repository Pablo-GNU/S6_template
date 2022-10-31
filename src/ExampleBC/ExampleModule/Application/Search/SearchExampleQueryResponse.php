<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Search;

use Code\Shared\Bus\Query\Domain\Response;

final class SearchExampleQueryResponse implements Response
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $surname,
        private readonly int $age,
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
