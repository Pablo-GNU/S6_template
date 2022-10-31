<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Command\Infrastructure\Symfony;

use Code\Shared\Bus\Command\Domain\Command;
use Code\Shared\Bus\Command\Domain\CommandBus;
use Code\Shared\Bus\Command\Domain\Exceptions\CommandNotRegisteredError;
use Code\Shared\Bus\Shared\Infrastructure\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Throwable;

final class InMemoryCommandBus implements CommandBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $commandHandlers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
                ),
            ]
        );
    }

    /**
     * @throws Throwable
     */
    public function dispatch(Command $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (NoHandlerForMessageException) {
            throw new CommandNotRegisteredError($command);
        } catch (HandlerFailedException $error) {
            while ($error instanceof HandlerFailedException) {
                /** @var Throwable $error */
                $error = $error->getPrevious();
            }

            throw $error;
        }
    }
}
