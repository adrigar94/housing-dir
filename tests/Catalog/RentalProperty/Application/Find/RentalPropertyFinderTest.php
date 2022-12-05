<?php

namespace App\Tests\Catalog\RentalProperty\Application\Find;

use App\Catalog\RentalProperty\Application\Find\RentalPropertyFinder;
use App\Catalog\RentalProperty\Domain\RentalPropertyNotExist;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Tests\Catalog\RentalProperty\Domain\RentalPropertyMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyIdMother;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RentalPropertyFinderTest extends KernelTestCase
{
    private RentalPropertyRepository|MockObject $rentalRepositoryMock;

    protected function setUp(): void
    {
        $this->rentalRepositoryMock = $this->getMockBuilder(RentalPropertyRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }


    /** @test */
    public function it_should_valid_find_rental_property(): void
    {
        $property = RentalPropertyMother::create();

        $this->rentalRepositoryMock
            ->expects($this->once())
            ->method('findById')
            ->with($property->id())
            ->willReturn($property);
        
        $finder = new RentalPropertyFinder($this->rentalRepositoryMock);
        $propertyReturned = $finder->__invoke($property->id());
        $this->assertSame($property,$propertyReturned);
    }


    /** @test */
    public function it_should_throw_exception_when_find_rental_property_not_exists(): void
    {
        $this->expectException(RentalPropertyNotExist::class);
        
        $this->rentalRepositoryMock
            ->expects($this->once())
            ->method('findById');
        
        $finder = new RentalPropertyFinder($this->rentalRepositoryMock);
        $finder->__invoke(PropertyIdMother::create());
    }
}
