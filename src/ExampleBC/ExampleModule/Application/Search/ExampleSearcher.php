<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Search;

use Code\ExampleBC\ExampleModule\Domain\Example;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\Persistence\ExampleRepositoryInterface;

final class ExampleSearcher
{
    public function __construct(private readonly ExampleRepositoryInterface $repository)
    {
    }

    public function __invoke(ExampleId $exampleId): ?Example
    {
        return $this->repository->search($exampleId);
    }
}
