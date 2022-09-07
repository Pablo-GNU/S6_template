<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Event\Domain;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}