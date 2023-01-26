<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\RabbitMq;

use App\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConsumer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(name: 'housing-dir:domain-events:rabbitmq:consume')]
final class ConsumeRabbitMqDomainEventsCommand extends Command
{
    public function __construct(
        private RabbitMqConsumer $rabbitConsumer,
        private DomainEventSubscriberLocator $subscriberLocator
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from RabbitMq')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue name')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueName = (string) $input->getArgument('queue');
        $quantityEventsToProcess = (int) $input->getArgument('quantity');

        for ($i = 0; $i < $quantityEventsToProcess; $i++) {
            call_user_func($this->consumer($queueName));
        }

        return 0;
    }

    private function consumer(string $queueName): callable
    {
        return function () use ($queueName) {
            $subscriber = $this->subscriberLocator->withRabbitMqQueueNamed($queueName);

            $this->rabbitConsumer->consume($subscriber, $queueName);
        };
    }


    // private function manageMessage(AMQPMessage $msg): void
    // {
    //     echo json_encode([
    //         'routing_key' => $msg->getRoutingKey(),
    //         'body' => $msg->getBody(),
    //         'delivery_tag' => $msg->getDeliveryTag(),
    //         'properties' => $msg->get_properties(),
    //     ]) . PHP_EOL;

    //     $this->consumer->processedMessage($msg->getDeliveryTag());
    // }
}
