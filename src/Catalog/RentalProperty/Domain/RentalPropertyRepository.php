<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\PropertyId;

interface RentalPropertyRepository
{
    public function save(RentalProperty $property): void;

    public function search(PropertyId $id): ?RentalProperty;
}
