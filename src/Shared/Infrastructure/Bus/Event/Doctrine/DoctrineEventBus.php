<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event\Doctrine;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineEventBus implements EventBus
{
    private $connection;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->publisher($event);
        }
    }

    private function publisher(DomainEvent $domainEvent): void
    {
        $id = $this->connection->quote($domainEvent->eventId());
        $aggregateId = $this->connection->quote($domainEvent->aggregateId());
        $name = $this->connection->quote($domainEvent->eventName());
        $body = $this->connection->quote(json_encode($domainEvent->bodyToPrimitives()));
        $occuredOn = $this->connection->quote(date('Y-m-d H:i:s', $domainEvent->occurredOn()));

        $params = [
            ':id' => $id,
            ':aggregateId' => $aggregateId,
            ':name' => $name,
            ':body' => $body,
            ':occuredOn' => $occuredOn,
        ];
        $sql = 'INSERT INTO domain_events (id, aggregate_id, name, body, ocurred_on)
                                    VALUES (:id, :aggregateId, :name, :body, :occuredOn);';

        $this->connection->executeQuery(\strtr($sql, $params))->fetchAllAssociative();
    }
}
