<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Domain\Persistence;

use Code\ExampleBC\ExampleModule\Domain\Example;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\Shared\Persistence\Domain\RepositoryInterface;

interface ExampleRepositoryInterface extends RepositoryInterface
{
    public const EXAMPLE = "example";

    public function create(Example $example): void;

    public function search(ExampleId $exampleId): ?Example;

    public function update(Example $example): void;

    public function delete(ExampleId $exampleId): void;
}
