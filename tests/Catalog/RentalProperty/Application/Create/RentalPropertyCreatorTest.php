<?php

namespace App\Tests\Catalog\RentalProperty\Application\Create;

use App\Catalog\RentalProperty\Application\Create\RentalPropertyCreator;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Catalog\Shared\Domain\Property\PropertyCommonCharacteristicsMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyGalleryMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyIdMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyLocationMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyPriceMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyTitleMother;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RentalPropertyCreatorTest extends KernelTestCase
{
    private RentalPropertyRepository|MockObject $rentalRepositoryMock;
    private EventBus|MockObject $eventBusMock;

    protected function setUp(): void
    {
        $this->rentalRepositoryMock = $this->getMockBuilder(RentalPropertyRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        
        $this->eventBusMock = $this->getMockBuilder(EventBus::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }

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

        $this->rentalRepositoryMock
            ->expects($this->once())
            ->method('save');
        
        $this->eventBusMock
            ->expects($this->once())
            ->method('publish');

        $creator = new RentalPropertyCreator($this->rentalRepositoryMock, $this->eventBusMock);
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
