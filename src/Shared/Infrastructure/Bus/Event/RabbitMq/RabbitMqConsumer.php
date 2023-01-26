<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Infrastructure\Bus\Event\DomainEventJsonDeserializer;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMqConsumer
{
    public function __construct(
        private RabbitMqConnection $connectionService,
        private DomainEventJsonDeserializer $deserializer
    ) {
    }
    public function consume(callable $subscriber, string $queueName): void
    {
        $msg = $this->connectionService->getChannel()->basic_get($queueName);

        if(!$msg){
            return;
        }

        $event = $this->deserializer->deserialize($msg->getRoutingKey(),$msg->getBody());

        $subscriber($event); // TODO: handle error with try catch. in catch move to retry queue

        $this->processedMessage($msg->getDeliveryTag());
    }
    
    private function processedMessage(int $delivery_tag): void
    {
        $this->connectionService->getChannel()->basic_ack($delivery_tag);
    }

}