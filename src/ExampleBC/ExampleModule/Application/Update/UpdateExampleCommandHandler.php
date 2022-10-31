<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Update;

use Code\ExampleBC\ExampleModule\Domain\ExampleAge;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\ExampleName;
use Code\ExampleBC\ExampleModule\Domain\ExampleSurname;
use Code\Shared\Bus\Command\Domain\CommandHandler;
use Throwable;

final class UpdateExampleCommandHandler implements CommandHandler
{
    public function __construct(private readonly ExampleUpdater $updater)
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(UpdateExampleCommand $command): void
    {
        $this->updater->__invoke(
            new ExampleId($command->id()),
            new ExampleName($command->name()),
            new ExampleSurname($command->surname()),
            new ExampleAge($command->age())
        );
    }
}
