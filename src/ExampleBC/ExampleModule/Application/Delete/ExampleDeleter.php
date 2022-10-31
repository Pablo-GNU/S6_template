<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Delete;

use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\Persistence\ExampleRepositoryInterface;

final class ExampleDeleter
{
    public function __construct(private readonly ExampleRepositoryInterface $repository)
    {
    }

    public function __invoke(ExampleId $exampleId): void
    {
        $this->repository->delete($exampleId);
    }
}
