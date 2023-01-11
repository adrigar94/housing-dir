<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use ReflectionClass;

class HandlerBuilder
{
    public static function fromCallables(iterable $callables): array
    {
        $callablesHandlers = [];

        foreach ($callables as $callable) {
            $envelop = self::extractFirstParam($callable);

            if (!array_key_exists($envelop, $callablesHandlers)) {
                $callablesHandlers[self::extractFirstParam($callable)] = [];
            }

            $callablesHandlers[self::extractFirstParam($callable)][] = $callable;
        }

        return $callablesHandlers;
    }

    private static function extractFirstParam(object|string $class): string|null
    {
        $reflection = new ReflectionClass($class);
        $method     = $reflection->getMethod('__invoke');

        if ($method->getNumberOfParameters() === 1) {
            return $method->getParameters()[0]->getType()?->getName();
        }

        return null;
    }

    public static function forPipedCallables(iterable $callables): array
    {
        $callablesArray = iterator_to_array($callables);
        
        return array_reduce(
            $callablesArray,
            static function ($subscribers, DomainEventSubscriber $subscriber) {
                $subscribedEvents = $subscriber::subscribedTo();

                foreach ($subscribedEvents as $subscribedEvent) {
                    $subscribers[$subscribedEvent][] = $subscriber;
                }

                return $subscribers;
            },
            []
        );
    }
}
