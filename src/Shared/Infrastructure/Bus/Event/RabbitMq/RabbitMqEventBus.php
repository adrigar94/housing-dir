<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMqEventBus implements EventBus
{
    private AMQPChannel $channel;

    public function __construct(private RabbitMqConnection $connectionService
    )
    {
        $this->channel = $connectionService->getChannel();
        $this->channel->queue_declare('hello', auto_delete: false);
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
        $msg = new AMQPMessage(json_encode($domainEvent->bodyToPrimitives()));
        $this->channel->basic_publish($msg, '', 'hello');
    }
}