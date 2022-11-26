<?php

namespace App\Catalog\RentalProperty\Application\Find;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyNotExist;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Property\PropertyId;

final class RentalPropertyFinder
{
    public function __construct(private RentalPropertyRepository $repository)
    {
    }


    public function __invoke(PropertyId $id): RentalProperty
    {
        $property = $this->repository->findById($id);

        if (null === $property) {
            throw new RentalPropertyNotExist($id);
        }

        return $property;
    }
}
