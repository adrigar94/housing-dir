<?php

namespace App\Tests\Catalog;

use App\Catalog\RentalProperty\Application\Create\RentalPropertyCreator;
use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Catalog\Shared\Domain\Property\PropertyCommonCharacteristicsMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyGalleryMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyIdMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyLocationMother;
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
        $characteristics = PropertyCommonCharacteristicsMother::create();
        $location = PropertyLocationMother::create();
        $gallery = PropertyGalleryMother::create();
        $price = PropertyPriceMother::create();
        $petsAllowed = new BoolValueObject(false);

        $rentalAd = new RentalProperty(
            $rentalId,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery,
            $price,
            $petsAllowed
        );

        $this->assertEquals($rentalAd->id()->value(), $rentalId->value(), "testing id");
        $this->assertEquals($rentalAd->title()->value(), $title->value(), "testing title");
        $this->assertEquals($rentalAd->description()->value(), $description->value(), "testing description");
        $this->assertEquals($rentalAd->characteristics(), $characteristics, "testing characteristics");
        $this->assertEquals($rentalAd->location(), $location, "testing location");
        $this->assertEquals($rentalAd->gallery(), $gallery, "testing gallery");
        $this->assertEquals($rentalAd->priceMonth(), $price, "testing price");

        // $rentalRepository = $this->getMockBuilder(RentalPropertyRepository::class)->getMock();
        // $rentalRepository->expects($this->once())
        //     ->method('save');
        // TODO mock

        $creator = new RentalPropertyCreator($this->createMock(RentalPropertyRepository::class));
        $creator->__invoke(
            $rentalId,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery,
            $price,
            $petsAllowed
        );
    }
}
