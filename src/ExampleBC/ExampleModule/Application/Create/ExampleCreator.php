<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Create;

use Code\ExampleBC\ExampleModule\Domain\Example;
use Code\ExampleBC\ExampleModule\Domain\ExampleAge;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\ExampleName;
use Code\ExampleBC\ExampleModule\Domain\ExampleSurname;
use Code\ExampleBC\ExampleModule\Domain\Persistence\ExampleRepositoryInterface;
use Throwable;

final class ExampleCreator
{
    public function __construct(private readonly ExampleRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(
        ExampleId $id,
        ExampleName $name,
        ExampleSurname $surname,
        ExampleAge $age
    ): void {
        $example = new Example(
            $id,
            $name,
            $surname,
            $age
        );

        try {
            $this->repository->startTransaction();
            $this->repository->create($example);
            $this->repository->commitTransaction();
        } catch (Throwable $throwable) {
            $this->repository->rollBackTransaction();

            throw $throwable;
        }
    }
}
