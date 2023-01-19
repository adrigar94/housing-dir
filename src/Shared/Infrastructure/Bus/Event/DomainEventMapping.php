<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use RuntimeException;

final class DomainEventMapping
{
    private $mapping;

    public function __construct(iterable $mapping)
    {
        $this->mapping = array_reduce(iterator_to_array($mapping), function (array $carry, $subscriber) {
            return array_merge($carry, $this->reindex($this->eventNameExtractor(), $subscriber::subscribedTo()));
        }, []);
    }

    public function for(string $name)
    {
        if (!isset($this->mapping[$name])) {
            throw new RuntimeException("The Domain Event Class for <$name> doesn't exists or have no subscribers");
        }

        return $this->mapping[$name];
    }

    private function reindex(callable $fn, iterable $coll): array
    {
        $result = [];

        foreach ($coll as $key => $value) {
            $result[$fn($value, $key)] = $value;
        }

        return $result;
    }


    private function eventNameExtractor(): callable
    {
        return static function (string $eventClass): string {
            return $eventClass::eventName();
        };
    }
}
