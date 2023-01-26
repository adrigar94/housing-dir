<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use App\Shared\Infrastructure\Bus\HandlerBuilder;
use RuntimeException;
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

    /**
     * Summary of DomainEventSubscriber
     * @return DomainEventSubscriber[]
     */
    public function all(): array
    {
        return iterator_to_array($this->mapping);
    }


    public function withRabbitMqQueueNamed(string $queueName): DomainEventSubscriber
    {
        $subscriber = null;
        foreach ($this->mapping as $item) {
            if ($item instanceof DomainEventSubscriber && RabbitMqQueueNameFormatter::format($item) === $queueName) {
                $subscriber = $item;
                break;
            }
        }

        if (null === $subscriber) {
            throw new RuntimeException("There are no subscribers for the <$queueName> queue");
        }

        return $subscriber;
    }
}
