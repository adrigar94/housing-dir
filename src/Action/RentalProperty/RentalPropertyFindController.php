<?php

namespace App\Action\RentalProperty;

use App\Catalog\RentalProperty\Application\Find\RentalPropertyFinder;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
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

        return ApiResponse::createResponseOK([
            'status' => 'ok',
            'time' => new \DateTime(),
            'id' => $rental_property->id()->value(),
            'title' => $rental_property->title()->value(),
            'description' => $rental_property->description()->value(),
            'characteristics' => $rental_property->characteristics(),
            'location' => $rental_property->location(),
            'gallery' => $rental_property->gallery(),
            'created_at' => $rental_property->createdAt(),
            'updated_at' => $rental_property->updatedAt(),
            //'data' => $rental_property->toArray()
        ]);
    }
}
