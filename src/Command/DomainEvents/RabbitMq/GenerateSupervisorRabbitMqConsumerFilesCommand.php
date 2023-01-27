<?php

declare(strict_types=1);

namespace App\Command\DomainEvents\RabbitMq;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'housing-dir:domain-events:rabbitmq:generate-supervisor-files')]
final class GenerateSupervisorRabbitMqConsumerFilesCommand extends Command
{
    private const EVENTS_TO_PROCESS_AT_TIME = 200;
    private const NUMBERS_OF_PROCESSES_PER_SUBSCRIBER = 1;
    private const SUPERVISOR_PATH = __DIR__ . '/../../../../build/supervisor';

    private const PREFIX_FILES = 'domain_event_consumer.';

    public function __construct(private DomainEventSubscriberLocator $locator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate the supervisor configuration for every RabbitMQ subscriber')
            ->addArgument('command-path', InputArgument::OPTIONAL, 'Path on this is gonna be deployed', '/appdata/www');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Generate the supervisor configuration for every RabbitMQ subscriber');

        $path = (string) $input->getArgument('command-path');

        $this->createSupervisorFolderIfNotExists();

        $io->info("Delete old files supervisor configuration");
        $this->deleteOldFiles();

        $subscribers = $this->locator->all();
        $io->progressStart(count($subscribers));

        foreach ($subscribers as $subscriber) {
            $io->info("Generate the supervisor configuration for " . $subscriber::class);
            $this->configCreator($path, $subscriber);
            $io->progressAdvance();
        }
        $io->progressFinish();

        $io->success("Files generated!");

        return 0;
    }

    private function createSupervisorFolderIfNotExists() {
        if (!is_dir(self::SUPERVISOR_PATH)) {
            mkdir(self::SUPERVISOR_PATH, 0777, true);
        }
    }

    private function deleteOldFiles():void
    {
        $dir = opendir(self::SUPERVISOR_PATH);

        while (false !== ($file = readdir($dir))) {
            if (strpos($file, self::PREFIX_FILES) === 0) {
                $filePath = self::SUPERVISOR_PATH . '/' . $file;
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
        }
        closedir($dir);
    }

    private function configCreator(string $path, DomainEventSubscriber $subscriber): void
    {
        $queueName      = RabbitMqQueueNameFormatter::format($subscriber);
        $subscriberName = self::PREFIX_FILES . substr($queueName, strrpos($queueName, '.') + 1);

        $fileContent = str_replace(
            [
                '{subscriber_name}',
                '{queue_name}',
                '{path}',
                '{processes}',
                '{events_to_process}',
            ],
            [
                $subscriberName,
                $queueName,
                $path,
                self::NUMBERS_OF_PROCESSES_PER_SUBSCRIBER,
                self::EVENTS_TO_PROCESS_AT_TIME
            ],
            $this->template()
        );

        file_put_contents($this->fileName($subscriberName), $fileContent);
    }
    private function template(): string
    {
        return <<<EOF
[program:housing-dir_{queue_name}]
command      = {path}/bin/console housing-dir:domain-events:rabbitmq:consume --env=prod {queue_name} {events_to_process}
process_name = %(program_name)s_%(process_num)02d
numprocs     = {processes}
startsecs    = 1
startretries = 10
exitcodes    = 0
stopwaitsecs = 300
autostart    = true
autorestart  = true
EOF;
    }

    private function fileName(string $queue)
    {
        return sprintf('%s/%s.conf', self::SUPERVISOR_PATH, $queue);
    }
}
