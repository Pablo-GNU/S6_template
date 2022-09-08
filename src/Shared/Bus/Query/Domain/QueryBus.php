<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Query\Domain;

interface QueryBus
{
    public function ask(Query $query): ?Response;
}
