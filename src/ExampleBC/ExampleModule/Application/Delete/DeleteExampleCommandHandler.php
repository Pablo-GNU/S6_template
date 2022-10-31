<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Delete;

use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\Shared\Bus\Command\Domain\CommandHandler;

final class DeleteExampleCommandHandler implements CommandHandler
{
    public function __construct(private readonly ExampleDeleter $deleter)
    {
    }

    public function __invoke(DeleteExampleCommand $command): void
    {
        $this->deleter->__invoke(new ExampleId($command->id()));
    }
}
