<?php

declare(strict_types=1);

namespace Code\Shared\Persistence\Domain;

interface RepositoryInterface
{
    public function startTransaction(): void;

    public function commitTransaction(): void;

    public function rollBackTransaction(): void;
}
