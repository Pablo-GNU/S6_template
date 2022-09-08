<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Query\Infrastructure;

use Code\Shared\Bus\Query\Domain\Query;
use Code\Shared\Bus\Query\Domain\QueryBus;
use Code\Shared\Bus\Query\Domain\Response;
use Code\Shared\Bus\Query\Domain\Exceptions\QueryNotRegisteredError;
use Code\Shared\Bus\Shared\Infrastructure\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

final class InMemorySymfonyQueryBus implements QueryBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $queryHandlers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(CallableFirstParameterExtractor::forCallables($queryHandlers))
                ),
            ]
        );
    }

    /**
     * @throws Throwable
     */
    public function ask(Query $query): ?Response
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException) {
            throw new QueryNotRegisteredError($query);
        } catch (HandlerFailedException $error) {
            while ($error instanceof HandlerFailedException) {
                /** @var Throwable $error */
                $error = $error->getPrevious();
            }

            throw $error;
        }
    }
}