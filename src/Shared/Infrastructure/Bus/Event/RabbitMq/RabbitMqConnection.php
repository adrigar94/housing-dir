<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPSocketConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

final class RabbitMqConnection
{
    private AMQPSocketConnection $connection;
    private AMQPChannel $channel;

    public function __construct(
        $host,
        $port,
        $user,
        $password
    ) {
        $this->connection = new AMQPSocketConnection(
            $host,
            $port,
            $user,
            $password
        );

        $this->channel = $this->connection->channel();
    }

    public function getConnection(): AMQPSocketConnection
    {
        return $this->connection;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}
