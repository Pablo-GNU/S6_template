<?php

declare(strict_types=1);

namespace Code\App\Controller;

use Code\Shared\Bus\Command\Domain\Command;
use Code\Shared\Bus\Command\Domain\CommandBus;
use Code\Shared\Bus\Query\Domain\Query;
use Code\Shared\Bus\Query\Domain\QueryBus;
use Code\Shared\Bus\Query\Domain\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    private CommandBus $commandBus;
    private QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }

    public function ask(Query $query): Response
    {
        return $this->queryBus->ask($query);
    }
}