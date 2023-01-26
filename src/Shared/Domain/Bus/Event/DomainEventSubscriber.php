<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\Event;

interface DomainEventSubscriber
{
    /**
     * Summary of DomainEvents subscribed
     * @return DomainEvent[]
     */
    public static function subscribedTo(): array;
    public function __invoke(DomainEvent $event): void;
}
