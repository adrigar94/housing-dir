<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMqEventBus implements EventBus
{

    public function __construct(
        private RabbitMqConnection $connectionService,
        private string $exchangeName
    ) {
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
            json_encode($domainEvent->toPrimitives()),
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
        $this->connectionService->getChannel()->basic_publish($msg, $this->exchangeName, $routing_key);
    }
}
