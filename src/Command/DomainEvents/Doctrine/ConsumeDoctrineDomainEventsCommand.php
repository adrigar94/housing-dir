<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\Doctrine;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Infrastructure\Bus\Event\Doctrine\DoctrineEventConsumer;
use App\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'housing-dir:domain-events:doctrine:consume')]
final class ConsumeDoctrineDomainEventsCommand extends Command
{
    public function __construct(
        private DoctrineEventConsumer $consumer,
        private DomainEventSubscriberLocator $subscriberLocator
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from Doctrine')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $quantityEventsToProcess = (int) $input->getArgument('quantity');

        $consumer = $this->consumer();

        $this->consumer->consume($consumer, $quantityEventsToProcess);

        return 0;
    }


    private function consumer(): callable
    {
        return function (DomainEvent $domainEvent) {
            $subscribers = $this->subscriberLocator->allSubscribedTo(get_class($domainEvent));

            foreach ($subscribers as $subscriber) {
                $subscriber($domainEvent);
            }
        };
    }
}
