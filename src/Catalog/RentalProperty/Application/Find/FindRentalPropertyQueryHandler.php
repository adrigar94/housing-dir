<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Find;

use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Shared\Domain\Bus\Query\QueryHandler;

class FindRentalPropertyQueryHandler implements QueryHandler
{
    public function __construct(private RentalPropertyFinder $finder)
    {
    }

    public function __invoke(FindRentalPropertyQuery $query): FindRentalPropertyResponse
    {
        $rentalPropertyId = new PropertyId($query->getId());
        $rentalProperty = $this->finder->__invoke($rentalPropertyId);
        
        return new FindRentalPropertyResponse($rentalProperty);
    }

}