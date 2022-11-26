<?php

namespace App\Controller\RentalProperty;

use App\Catalog\RentalProperty\Application\Find\RentalPropertyFinder;
use App\Catalog\Shared\Domain\Property\PropertyId;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentalPropertyFindController
{
    public function __construct(private RentalPropertyFinder $finder)
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        $propertyId = new PropertyId($id);
        $rental_property = $this->finder->__invoke($propertyId);

        return new JsonResponse(
            [
                'status' => 'ok',
                'time' => new \DateTime(),
                'id' => $rental_property->id()->value(),
                'title' => $rental_property->title()->value()
            ],
            JsonResponse::HTTP_OK
        );
    }
}
