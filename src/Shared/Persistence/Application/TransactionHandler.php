<?php

declare(strict_types=1);

namespace Code\Shared\Persistence\Application;

use Code\Shared\Bus\Query\Domain\Response;
use Code\Shared\Persistence\Domain\TransactionalRepositoryInterface;
use Throwable;

final class TransactionHandler
{
    public function __construct(private readonly TransactionalRepositoryInterface $repository)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(callable $fn): ?Response
    {
        try {
            $this->repository->startTransaction();
            $response = $fn();
            $this->repository->commitTransaction();

            return $response;
        } catch (Throwable $e) {
            $this->repository->rollBackTransaction();

            throw $e;
        }
    }
}
