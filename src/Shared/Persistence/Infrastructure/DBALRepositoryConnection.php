<?php

declare(strict_types=1);

namespace Code\Shared\Persistence\Infrastructure;

use Code\Shared\Persistence\Domain\RepositoryInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class DBALRepositoryConnection extends Connection implements RepositoryInterface
{
    /**
     * @throws Exception
     */
    public function startTransaction(): void
    {
        $this->beginTransaction();
    }

    /**
     * @throws Exception
     */
    public function commitTransaction(): void
    {
        $this->commit();
    }

    /**
     * @throws Exception
     */
    public function rollBackTransaction(): void
    {
        $this->rollBack();
    }
}
