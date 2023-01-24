<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Create;

use App\Shared\Domain\Bus\Event\DomainEvent;

class RentalPropertyCreatedEvent extends DomainEvent
{
    private array $body;

    public function __construct(
        string $aggregateId,
        array $body,
        string $eventId,
        int $occurredOn
    ) {
        parent::__construct($eventId, $aggregateId, $occurredOn);
        $this->body = $body;
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        int $occurredOn
    ): self {
        return new self($aggregateId, $body, $eventId, $occurredOn);
    }

    public function bodyToPrimitives(): array
    {
        return $this->body();
    }

    public static function eventName(): string
    {
        return 'domain-event.property.rental.created';
    }

    public function body(): array
    {
        return $this->body;
    }
}
