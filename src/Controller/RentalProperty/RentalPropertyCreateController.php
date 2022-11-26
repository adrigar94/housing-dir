<?php

namespace App\Controller\RentalProperty;

use App\Catalog\RentalProperty\Application\Create\RentalPropertyCreator;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Catalog\Shared\Domain\Property\PropertyCommonCharacteristicsMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyIdMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyPriceMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyTitleMother;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RentalPropertyCreateController
{
    public function __construct(private RentalPropertyCreator $creator)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());

        $rentalId = PropertyIdMother::create();
        $title = PropertyTitleMother::create($data->title);
        $description = PropertyDescriptionMother::create();
        $characteristics = PropertyCommonCharacteristicsMother::create();
        $location = new PropertyLocation();
        $gallery = new PropertyGallery();
        $price = PropertyPriceMother::create();
        $petsAllowed = new BoolValueObject(false);

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

        return new JsonResponse(
            [
                'status' => 'ok',
                'time' => new \DateTime(),
                'id' => $rentalId->value(),
                'title' => $title->value()
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
