<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\Event;

use App\Shared\Domain\ValueObject\Uuid;

abstract class DomainEvent
{
    public function __construct(
        private string $eventId,
        private string $aggregateId,
        private int $occurredOn
    ) {
    }

    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        int $occurredOn
    ): self;

    abstract public function toPrimitives(): array;
    abstract public function bodyToPrimitives(): array;

    abstract public static function eventName(): string;

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }
}
