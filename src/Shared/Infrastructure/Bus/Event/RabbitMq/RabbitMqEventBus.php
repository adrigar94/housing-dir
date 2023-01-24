<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMqEventBus implements EventBus
{
    private const EXCHANGE_NAME = "domain_events";

    public function __construct(
        private RabbitMqConnection $connectionService
    ) {
        $this->connectionService->getChannel()->exchange_declare(self::EXCHANGE_NAME, 'topic', false, true, false);
    }

    public function __destruct()
    {
        $this->connectionService->close();
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->publisher($event);
        }
    }

    private function publisher(DomainEvent $domainEvent): void
    {
        $msg = new AMQPMessage(
            json_encode($domainEvent->bodyToPrimitives()),
            [
                'message_id' => $domainEvent->eventId(),
                'timestamp' => $domainEvent->occurredOn(),
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                'content_type' => 'application/json',
                'content_encoding' => 'utf-8',
            ]
        );
        $this->publishToRabbit($msg, $domainEvent->eventName());
    }


    private function publishToRabbit(AMQPMessage $msg, string $routing_key): void
    {
        $this->connectionService->getChannel()->basic_publish($msg, self::EXCHANGE_NAME, $routing_key);
    }

    public function declareQueue($queue_name, array $binding_keys): void
    {
        $this->connectionService->getChannel()->queue_declare($queue_name, false, true, false, false, false);
        foreach ($binding_keys as $binding_key) {
            $this->connectionService->getChannel()->queue_bind($queue_name, self::EXCHANGE_NAME, $binding_key);
        }
    }

    public function consume($queue_name): ?AMQPMessage
    {
        return $this->connectionService->getChannel()->basic_get($queue_name);
    }

    public function processedMessage(int $delivery_tag): void
    {
        $this->connectionService->getChannel()->basic_ack($delivery_tag);
    }
}
