<?php

namespace App\Catalog\RentalProperty\Infrastructure\Persistence;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Property\PropertyId;
use Doctrine\ORM\EntityManager;

final class DoctrineRentalPropertyRepository implements RentalPropertyRepository
{

    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function save(RentalProperty $property): void
    {
        $this->entityManager->persist($property);
        $this->entityManager->flush($property);
    }

    public function search(PropertyId $id): ?RentalProperty
    {
        return null;
    }
}
