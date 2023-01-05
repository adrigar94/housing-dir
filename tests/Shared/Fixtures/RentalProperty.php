<?php

use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Catalog\Shared\Domain\Property\PropertyCommonCharacteristicsMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyGalleryMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyLocationMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyPriceMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyTitleMother;

$propertyId = '926126de-8d1c-11ed-a1eb-0242ac120002';
$propertyId2 = '337c5444-8d1d-11ed-a1eb-0242ac120002';

return [
    'App\Catalog\RentalProperty\Domain\RentalProperty' => [
        'rentalProperty1' => [
            '__construct' => [
                'id' => new PropertyId($propertyId),
                'title' => PropertyTitleMother::create(),
                'description' => PropertyDescriptionMother::create(),
                'characteristics' => PropertyCommonCharacteristicsMother::create(),
                'location' => PropertyLocationMother::create(),
                'gallery' => PropertyGalleryMother::create(),
                'price_month' => PropertyPriceMother::create(),
                'pets_allowed' => new BoolValueObject(true),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ],
        'rentalProperty2' => [
            '__construct' => [
                'id' => new PropertyId($propertyId2),
                'title' => PropertyTitleMother::create(),
                'description' => PropertyDescriptionMother::create(),
                'characteristics' => PropertyCommonCharacteristicsMother::create(),
                'location' => PropertyLocationMother::create(),
                'gallery' => PropertyGalleryMother::create(),
                'price_month' => PropertyPriceMother::create(),
                'pets_allowed' => new BoolValueObject(true),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]
    ],
];
