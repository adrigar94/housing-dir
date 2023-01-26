<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use RuntimeException;

final class DomainEventJsonDeserializer
{
    private $mapping;

    public function __construct(DomainEventMapping $mapping)
    {
        $this->mapping = $mapping;
    }

    public function deserialize(string $eventName, string $domainEvent): DomainEvent
    {
        $eventData  = json_decode($domainEvent, true);
        $eventClass = $this->mapping->for($eventName);

        if (null === $eventClass) {
            throw new RuntimeException("The event <$eventName> doesn't exist or has no subscribers");
        }

        return $eventClass::fromPrimitives(
            $eventData['aggregate_id'],
            $eventData['data'],
            $eventData['id'],
            $eventData['occurred_on']
        );
    }
}
