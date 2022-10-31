<?php

declare(strict_types=1);

namespace Code\Shared\Persistence\Infrastructure;

use Code\Shared\Persistence\Infrastructure\DBAL\DBALRepositoryConnection;
use Code\Shared\Persistence\Domain\TransactionalRepositoryInterface;

final class TransactionalRepository extends DBALRepositoryConnection implements TransactionalRepositoryInterface
{
}
