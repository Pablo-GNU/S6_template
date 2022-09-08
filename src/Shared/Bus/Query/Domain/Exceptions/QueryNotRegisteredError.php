<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Query\Domain\Exceptions;

use Code\Shared\Bus\Query\Domain\Query;
use RuntimeException;

final class QueryNotRegisteredError extends RuntimeException
{
    public function __construct(Query $query)
    {
        $queryClass = $query::class;

        parent::__construct('The query ' . $queryClass . " hasn't a query handler associated");
    }
}
