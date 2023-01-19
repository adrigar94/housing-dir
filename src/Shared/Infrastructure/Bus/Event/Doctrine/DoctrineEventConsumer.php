<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\Doctrine;

use App\Shared\Infrastructure\Bus\Event\DomainEventMapping;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineEventConsumer
{
    private $connection;
    private $eventMapping;

    public function __construct(EntityManagerInterface $entityManager, DomainEventMapping $eventMapping)
    {
        $this->connection = $entityManager->getConnection();
        $this->eventMapping = $eventMapping;
    }

    public function consume(callable $subscribers, int $eventsToConsume): void
    {
        // TODO: manage error in consume error 
        $events = $this->connection
            ->executeQuery("SELECT * FROM domain_events ORDER BY ocurred_on ASC LIMIT $eventsToConsume")
            ->fetchAllAssociative();
        
        $ids = [];
        foreach ($events as $event) {
            $this->executeSubscribers($subscribers, $event);
            $ids[] = sprintf("'%s'",$event['id']);
        }
        $idsString = implode(', ', $ids);

        if (!empty($idsString)) {
            $this->connection->executeQuery("DELETE FROM domain_events WHERE id IN ($idsString)");
        }

    }

    private function executeSubscribers(callable $subscribers, array $rawEvent)
    {
        try {
            $domainEventClass = $this->eventMapping->for($rawEvent['name']);
            $domainEvent = $domainEventClass::fromPrimitives(
                $rawEvent['aggregate_id'],
                json_decode($rawEvent['body'], true),
                $rawEvent['id'],
                $this->formatDate($rawEvent['ocurred_on'])
            );
            $subscribers($domainEvent);
        } catch (\Throwable $th) {
            //throw $th;
            dd('doctrineEventConsumer',$th);
        }
    }

    private function formatDate(string $date): int
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $date)->getTimestamp();
    }
}
