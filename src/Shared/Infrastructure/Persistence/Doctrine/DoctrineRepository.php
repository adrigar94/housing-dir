<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineRepository
{

    protected ObjectRepository $object_repository;

    public function __construct(private ManagerRegistry $manager_registry, protected Connection $connection)
    {
        $this->object_repository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    abstract protected static function entityClass(): string;

    protected function getEntityManager(): ObjectManager|EntityManager
    {
        return $this->manager_registry->getManager();
    }

    protected function saveEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
