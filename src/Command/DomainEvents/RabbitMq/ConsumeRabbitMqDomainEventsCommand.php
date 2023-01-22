<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\RabbitMq;

use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsumeRabbitMqDomainEventsCommand extends Command
{
    private AMQPChannel $channel;

    public function __construct(
        private RabbitMqConnection $connectionService
    ) {
        parent::__construct();

        $this->channel = $connectionService->getChannel();
        $this->channel->queue_declare('hello', auto_delete: false, durable: true);
    }


    protected function configure(): void
    {
        $this
            ->setName('housing-dir:domain-events:rabbitmq:consume')
            ->setDescription('Consume domain events from RabbitMq')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $quantityEventsToProcess = (int) $input->getArgument('quantity');

        $consume = $this->consume();

        while (
            $msg = $this->channel->basic_get('hello')
            and $quantityEventsToProcess
        ) {
            $consume($msg);
            $quantityEventsToProcess--;
        }

        $this->connectionService->close();

        return 0;
    }

    private function consume(): callable
    {
        return function (AMQPMessage $msg) {
            echo $msg->getRoutingKey() . PHP_EOL;
            echo $msg->getBody() . PHP_EOL;
            echo $msg->getDeliveryTag() . PHP_EOL;
            echo json_encode($msg->get_properties()) . PHP_EOL;
            $this->channel->basic_ack($msg->getDeliveryTag());
        };
    }
}
