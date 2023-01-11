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
        string $occurredOn
    ) {
        parent::__construct($eventId, $aggregateId, $occurredOn);
        $this->body = $body;
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self {
        return new self($aggregateId, $body, $eventId, $occurredOn);
    }

    public static function toPrimitives(): array
    {
        return [
            'aggregateId' => self::aggregateId(),
            'body' => self::body(),
            'eventId' => self::eventId(),
            'occurredOn' => self::occurredOn()
        ];
    }

    public static function eventName(): string
    {
        return 'RentalPropertyCreatedEvent';
    }

    public function body(): array
    {
        return $this->body;
    }
}
