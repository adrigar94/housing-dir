<?php

namespace App\Tests\Catalog;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\Shared\Domain\Property\PropertyAdType;
use App\Catalog\Shared\Domain\Property\PropertyCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RentalPropertyTest extends KernelTestCase
{
    /** @test */
    public function it_should_valid_creation_rental_property(): void
    {
        $rentalId = PropertyId::random();
        $title = new PropertyTitle("Test rental ad");
        $description = new PropertyDescription("Test description for a rental ad");
        $type = PropertyAdType::rental();
        $characteristics = new PropertyCharacteristics();
        $location = new PropertyLocation();
        $gallery = new PropertyGallery();

        $rentalAd = new RentalProperty(
            $rentalId,
            $title,
            $description,
            $type,
            $characteristics,
            $location,
            $gallery
        );

        $this->assertEquals($rentalAd->id()->value(),$rentalId->value(),"testing id");
        $this->assertEquals($rentalAd->title()->value(),$title->value(),"testing title");
        $this->assertEquals($rentalAd->description()->value(),$description->value(),"description title");
        $this->assertEquals($rentalAd->type(),$type,"description type");
        $this->assertEquals($rentalAd->characteristics(),$characteristics,"description characteristics");
        $this->assertEquals($rentalAd->location(),$location,"description location");
        $this->assertEquals($rentalAd->gallery(),$gallery,"description gallery");
    }
}
