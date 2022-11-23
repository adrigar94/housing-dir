<?php

namespace App\Catalog\RentalProperty\Infrastructure\Persistence;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Property\PropertyId;

final class DoctrineRentalPropertyRepository implements RentalPropertyRepository
{
    public function save(RentalProperty $property): void
    {

    }

    public function search(PropertyId $id): ?RentalProperty
    {
        return null;
    }
}
