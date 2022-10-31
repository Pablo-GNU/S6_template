<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Search;

use Code\Shared\Bus\Query\Domain\Query;

final class SearchExampleQuery implements Query
{
    public function __construct(
        private readonly string $id
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }
}
