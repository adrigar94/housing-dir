<?php

namespace App\Catalog\RentalProperty\Application\SearchByCriteria;

use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Criteria\Criteria;
use App\Catalog\Shared\Domain\Criteria\Filters;
use App\Catalog\Shared\Domain\Criteria\Order;

final class RentalPropertySearcherByCriteria
{
    public function __construct(private RentalPropertyRepository $repository)
    {
    }


    public function __invoke(Filters $filters, Order $order, ?int $limit, ?int $offset): array
    {
        $criteria = new Criteria($filters, $order, $offset, $limit);
        return $this->repository->searchByCriteria($criteria);
    }

}