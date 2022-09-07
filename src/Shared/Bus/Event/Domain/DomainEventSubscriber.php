<?php

declare(strict_types=1);

namespace Code\Shared\Bus\Event\Domain;

interface DomainEventSubscriber
{
    public static function subscribedTo(): array;
}