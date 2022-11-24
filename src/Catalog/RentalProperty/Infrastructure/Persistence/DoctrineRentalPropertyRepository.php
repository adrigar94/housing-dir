<?php

namespace App\Catalog\RentalProperty\Infrastructure\Persistence;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Property\PropertyId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineRentalPropertyRepository extends ServiceEntityRepository implements RentalPropertyRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalProperty::class);
    }

    public function save(RentalProperty $property): void
    {
        $this->_em->persist($property);
        $this->_em->flush($property);
    }

    public function search(PropertyId $id): ?RentalProperty
    {
        return null;
    }
}
