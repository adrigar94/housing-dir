<?php

namespace App\Tests\Catalog\RentalProperty\Domain;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Catalog\Shared\Domain\Property\PropertyCommonCharacteristicsMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyGalleryMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyIdMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyLocationMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyPriceMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyTitleMother;

class RentalPropertyMother
{
    public static function create(): RentalProperty
    {
        $rentalId = PropertyIdMother::create();
        $title = PropertyTitleMother::create();
        $description = PropertyDescriptionMother::create();
        $characteristics = PropertyCommonCharacteristicsMother::create();
        $location = PropertyLocationMother::create();
        $gallery = PropertyGalleryMother::create();
        $price = PropertyPriceMother::create();
        $petsAllowed = new BoolValueObject(false);

        return new RentalProperty($rentalId, $title, $description, $characteristics, $location, $gallery, $price, $petsAllowed);
    }
}
