<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\RabbitMq;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPSocketConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMqConnection
{
    private AMQPSocketConnection $connection;
    private ?AMQPChannel $channel = null;

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
    }


    public function __destruct()
    {
        if ($this->channel) {
            $this->channel->close();
        }
        $this->connection->close();
    }

    private function getConnection(): AMQPSocketConnection
    {
        return $this->connection;
    }

    public function getChannel(): AMQPChannel
    {
        if (!$this->channel) {
            $this->channel = $this->getConnection()->channel();
        }
        return $this->channel;
    }
}
