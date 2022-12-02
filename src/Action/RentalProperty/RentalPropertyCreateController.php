<?php

namespace App\Action\RentalProperty;

use App\Catalog\RentalProperty\Application\Create\RentalPropertyCreator;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RentalPropertyCreateController
{
    public function __construct(private RentalPropertyCreator $creator)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $rentalId = PropertyId::random();
        $title = new PropertyTitle($data['title']);
        $description = new PropertyDescription($data['description']);
        $characteristics = PropertyCommonCharacteristics::fromArray($data['characteristics'] ?? []);
        $location = PropertyLocation::fromArray($data['location'] ?? []);
        $gallery = PropertyGallery::fromArray($data['gallery'] ?? []);
        $price = PropertyPrice::fromArray($data['price_month'] ?? []);
        $petsAllowed = isset($data['pets_allowed']) ? new BoolValueObject($data['pets_allowed']) : null;

        $this->creator->__invoke(
            $rentalId,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery,
            $price,
            $petsAllowed
        );


        return ApiResponse::createResponseCreated(
            [
                'status' => 'ok',
                'time' => new \DateTime(),
                'id' => $rentalId->value(),
                'title' => $title->value()
            ]
        );
    }
}
