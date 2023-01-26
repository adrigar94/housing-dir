<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class RabbitMqConfigurer
{
    public function __construct(
        private RabbitMqConnection $connectionService
    ) {
    }

    public function configure(string $exchangeName, DomainEventSubscriber ...$subscribers): void
    {
        $retryExchangeName = 'retry.' . $exchangeName;
        $deadLetterExchangeName = 'dead_letter.' . $exchangeName;
        $this->connectionService->getChannel()->exchange_declare($exchangeName, 'topic', false, true, false);
        $this->connectionService->getChannel()->exchange_declare($retryExchangeName, 'topic', false, true, false);
        $this->connectionService->getChannel()->exchange_declare($deadLetterExchangeName, 'topic', false, true, false);

        foreach ($subscribers as $subscriber) {
            $queueName = RabbitMqQueueNameFormatter::format($subscriber);
            $retryQueueName = RabbitMqQueueNameFormatter::formatRetry($subscriber);
            $deadLetterQueueName = RabbitMqQueueNameFormatter::formatDeadLetter($subscriber);
            
            $eventNames = $this->getEventNames($subscriber);

            $this->declareQueue($queueName, $exchangeName, $eventNames);
            $this->declareQueue($retryQueueName, $retryExchangeName, $eventNames);
            $this->declareQueue($deadLetterQueueName, $deadLetterExchangeName, $eventNames);
        }
    }

    private function declareQueue(string $queueName, string $exchangeName, array $binding_keys): void
    {
        $this->connectionService->getChannel()->queue_declare($queueName, false, true, false, false, false);
        foreach ($binding_keys as $binding_key) {
            $this->connectionService->getChannel()->queue_bind($queueName, $exchangeName, $binding_key);
        }
    }

    private function getEventNames(DomainEventSubscriber $subscriber): array
    {
        $eventNames = [];
        $subscribedTo = $subscriber->subscribedTo();
        foreach ($subscribedTo as $eventClass) {
            $eventNames[] = $eventClass::eventName();
        }
        return $eventNames;
    }
}
