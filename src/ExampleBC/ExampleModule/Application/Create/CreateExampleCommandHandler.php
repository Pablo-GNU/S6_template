<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Create;

use Code\ExampleBC\ExampleModule\Domain\ExampleAge;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\ExampleName;
use Code\ExampleBC\ExampleModule\Domain\ExampleSurname;
use Code\Shared\Bus\Command\Domain\CommandHandler;
use Throwable;

final class CreateExampleCommandHandler implements CommandHandler
{
    public function __construct(private readonly ExampleCreator $creator)
    {
    }

    /**
     * @throws Throwable
     */
    public function __invoke(CreateExampleCommand $command): void
    {
        $this->creator->__invoke(
            new ExampleId($command->id()),
            new ExampleName($command->name()),
            new ExampleSurname($command->surname()),
            new ExampleAge($command->age())
        );
    }
}
