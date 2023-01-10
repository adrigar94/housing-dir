<?php

namespace App\Catalog\RentalProperty\Application\SearchByCriteria;

use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Criteria\Criteria;
use App\Catalog\Shared\Domain\Criteria\Filter;
use App\Catalog\Shared\Domain\Criteria\FilterField;
use App\Catalog\Shared\Domain\Criteria\FilterOperator;
use App\Catalog\Shared\Domain\Criteria\Filters;
use App\Catalog\Shared\Domain\Criteria\FilterValue;
use App\Catalog\Shared\Domain\Criteria\Order;
use App\Catalog\Shared\Domain\Criteria\OrderBy;
use App\Catalog\Shared\Domain\Criteria\OrderType;
use App\Tests\Catalog\RentalProperty\Domain\RentalPropertyMother;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RentalPropertySearcherByCriteriaTest extends KernelTestCase
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
    public function it_should_valid_search_by_title_rental_property(): void
    {
        $property = RentalPropertyMother::create();

        $filters = new Filters([
            new Filter(
                new FilterField('title'),
                FilterOperator::EQUAL,
                new FilterValue($property->title()->value())
            )
        ]);
        $order = new Order(
            new OrderBy('created_at'),
            OrderType::NONE
        );
        
        $criteria = new Criteria($filters, $order, null, null);

        $this->rentalRepositoryMock
            ->expects($this->once())
            ->method('searchByCriteria')
            ->with($criteria)
            ->willReturn([$property]);
        
        $searcher = new RentalPropertySearcherByCriteria($this->rentalRepositoryMock);
        $propertiesReturned = $searcher->__invoke($filters,$order,null,null);

        $this->assertContains($property, $propertiesReturned);
    }
}
