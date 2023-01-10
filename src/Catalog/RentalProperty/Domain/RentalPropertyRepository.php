<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Criteria\Criteria;
use App\Catalog\Shared\Domain\Property\PropertyId;

interface RentalPropertyRepository
{
    public function save(RentalProperty $property): void;

    public function findById(PropertyId $id): ?RentalProperty;

    public function searchAll(): array;

    public function searchByCriteria(Criteria $criteria): array;
}
