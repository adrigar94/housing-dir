<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Infrastructure\Bus\HandlerBuilder;
use Traversable;

final class DomainEventSubscriberLocator
{
    private $mapping;

    public function __construct(Traversable $mapping)
    {
        $this->mapping = $mapping;
    }

    public function allSubscribedTo(string $eventClass): array
    {
        $formatted = HandlerBuilder::forPipedCallables($this->mapping);
        return $formatted[$eventClass];
    }

    public function all(): array
    {
        return iterator_to_array($this->mapping);
    }
}
