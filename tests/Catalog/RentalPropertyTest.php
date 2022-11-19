<?php

namespace App\Tests\Catalog;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Age;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\BathRooms;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\BuildingConservation;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Floor;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Orientations;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\OrientationsCollection;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\PropertyConstructionCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Rooms;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\SquareMeters;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\TypesConstruction;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\Consumption;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\Emissions;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\EnergyEfficiencyRating;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\PropertyEnergyCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs\PropertyEquipmentCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Shared\Domain\ValueObject\BoolValueObject;
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
        $characteristics = new PropertyCommonCharacteristics(
            new PropertyConstructionCharacterisitcs(
                new Rooms(2),
                new BathRooms(1),
                TypesConstruction::Home,
                new SquareMeters(200),
                new SquareMeters(100),
                new SquareMeters(50),
                new Age(30),
                BuildingConservation::Good,
                new Floor(3),
                new OrientationsCollection(Orientations::North,Orientations::East),
                new BoolValueObject(false)
            ),
            new PropertyEquipmentCharacterisitcs(
                new BoolValueObject(true),
                new BoolValueObject(true),
                new BoolValueObject(true),
                new BoolValueObject(true),
                new BoolValueObject(true),
                new BoolValueObject(true)
            ),
            new PropertyEnergyCharacterisitcs(
                new Consumption(3000, EnergyEfficiencyRating::A),
                new Emissions(1000, EnergyEfficiencyRating::A)
            )
        );
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
