<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class RabbitMqQueueNameFormatter
{
    public static function format(DomainEventSubscriber $subscriber): string
    {
        $subscriberClassPaths = explode('\\', get_class($subscriber));
        return implode(
            '.',
            array_map(self::toSnakeCase(), $subscriberClassPaths)
        );
    }

    public static function formatRetry(DomainEventSubscriber $subscriber): string
    {
        $queueName = self::format($subscriber);

        return "retry.$queueName";
    }

    public static function formatDeadLetter(DomainEventSubscriber $subscriber): string
    {
        $queueName = self::format($subscriber);

        return "dead_letter.$queueName";
    }

    private static function toSnakeCase(): callable
    {
        return static function (string $text) {
            return ctype_lower($text) ? $text : strtolower(preg_replace('/([^A-Z\s])([A-Z])/', "$1_$2", $text));
        };
    }
}
