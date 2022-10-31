<?php

declare(strict_types=1);

namespace Code\Shared\Persistence\Infrastructure\DBAL;

use Code\Shared\Persistence\Domain\RepositoryInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

class DBALRepositoryConnection implements RepositoryInterface
{
    public function __construct(protected readonly Connection $conn)
    {
    }

    public function queryBuilder(): QueryBuilder
    {
        return $this->conn->createQueryBuilder();
    }

    /**
     * @throws Exception
     */
    public function startTransaction(): void
    {
        $this->conn->beginTransaction();
    }

    /**
     * @throws Exception
     */
    public function commitTransaction(): void
    {
        $this->conn->commit();
    }

    /**
     * @throws Exception
     */
    public function rollBackTransaction(): void
    {
        $this->conn->rollBack();
    }
}
