<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\RabbitMq;

use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConfigurer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Traversable;

#[AsCommand(name: 'housing-dir:domain-events:rabbitmq:configure')]
final class ConfigureRabbitMqDomainEventsCommand extends Command
{
    public function __construct(
        private RabbitMqConfigurer $configurer,
        private string $exchangeName,
        private Traversable $subscribers
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Configure the RabbitMQ to allow publish & consume domain events');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->info("Configuring '$this->exchangeName' exchange and queues in rabbitMq");
        
        $this->configurer->configure($this->exchangeName, ...iterator_to_array($this->subscribers));

        $io->success("RabbitMq configured");
        return 0;
    }
}
