<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Update;

use Code\ExampleBC\ExampleModule\Application\Find\ExampleFinder;
use Code\ExampleBC\ExampleModule\Domain\ExampleAge;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\ExampleName;
use Code\ExampleBC\ExampleModule\Domain\ExampleSurname;
use Code\ExampleBC\ExampleModule\Domain\Persistence\ExampleRepositoryInterface;
use Throwable;

final class ExampleUpdater
{
    public function __construct(
        private readonly ExampleFinder $finder,
        private readonly ExampleRepositoryInterface $repository
    ) {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(
        ExampleId $exampleId,
        ExampleName $name,
        ExampleSurname $surname,
        ExampleAge $age
    ): void {
        $example = $this->finder->__invoke($exampleId);

        $example = $example->update(
            $name,
            $surname,
            $age
        );

        try {
            $this->repository->startTransaction();
            $this->repository->update($example);
            $this->repository->commitTransaction();
        } catch (Throwable $throwable) {
            $this->repository->rollBackTransaction();

            throw $throwable;
        }
    }
}
