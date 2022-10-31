<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Event\Infrastructure\Symfony;

use Code\Shared\Bus\Event\Domain\DomainEvent;
use Code\Shared\Bus\Event\Domain\EventBus;
use Code\Shared\Bus\Shared\Infrastructure\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class InMemoryEventBus implements EventBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $subscribers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(
                        CallableFirstParameterExtractor::forPipedCallables($subscribers)
                    )
                ),
            ]
        );
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            try {
                $this->bus->dispatch($event);
            } catch (NoHandlerForMessageException) {
            }
        }
    }
}
