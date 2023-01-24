<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\RabbitMq;

use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqEventBus;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(name: 'housing-dir:domain-events:rabbitmq:archive-all-domain-events-to-mysql')]
final class ArchiveAllEventDomainFromRabbitMqToMysql extends Command
{
    private const QUEUE_NAME = 'archive_all_event_domain_to_mysql';
    public function __construct(
        private RabbitMqEventBus $eventBus
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from RabbitMq')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $quantityEventsToProcess = (int) $input->getArgument('quantity');

        $this->eventBus->declareQueue(self::QUEUE_NAME, ['domain-event.#']);

        while (
            $msg = $this->eventBus->consume(self::QUEUE_NAME)
            and $quantityEventsToProcess
        ) {
            $this->manageMessage($msg);
            $quantityEventsToProcess--;
        }

        return 0;
    }

    private function manageMessage(AMQPMessage $msg): void
    {
        echo json_encode([
            'routing_key' => $msg->getRoutingKey(),
            'body' => $msg->getBody(),
            'delivery_tag' => $msg->getDeliveryTag(),
            'properties' => $msg->get_properties(),
        ]) . PHP_EOL;

        $this->eventBus->processedMessage($msg->getDeliveryTag());
    }
}
