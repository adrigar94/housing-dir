<?php

namespace App\Tests\Catalog;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\Shared\Domain\Property\PropertyAdType;
use App\Catalog\Shared\Domain\Property\PropertyCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyIdMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyPriceMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyTitleMother;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RentalPropertyTest extends KernelTestCase
{
    /** @test */
    public function it_should_valid_creation_rental_property(): void
    {
        $rentalId = PropertyIdMother::create();
        $title = PropertyTitleMother::create();
        $description = PropertyDescriptionMother::create();
        $characteristics = new PropertyCharacteristics();
        $location = new PropertyLocation();
        $gallery = new PropertyGallery();
        $price = PropertyPriceMother::create();

        $rentalAd = new RentalProperty(
            $rentalId,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery
        );

        $rentalAd->priceMonth($price);

        $this->assertEquals($rentalAd->id()->value(),$rentalId->value(),"testing id");
        $this->assertEquals($rentalAd->title()->value(),$title->value(),"testing title");
        $this->assertEquals($rentalAd->description()->value(),$description->value(),"description title");
        $this->assertEquals($rentalAd->characteristics(),$characteristics,"description characteristics");
        $this->assertEquals($rentalAd->location(),$location,"description location");
        $this->assertEquals($rentalAd->gallery(),$gallery,"description gallery");
        $this->assertEquals($rentalAd->priceMonth(),$price,"price gallery");
    }
}
