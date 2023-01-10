<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\SearchByCriteria;

use App\Catalog\Shared\Domain\Criteria\Filter;
use App\Catalog\Shared\Domain\Criteria\FilterField;
use App\Catalog\Shared\Domain\Criteria\FilterOperator;
use App\Catalog\Shared\Domain\Criteria\Filters;
use App\Catalog\Shared\Domain\Criteria\FilterValue;
use App\Catalog\Shared\Domain\Criteria\Order;
use App\Catalog\Shared\Domain\Criteria\OrderBy;
use App\Catalog\Shared\Domain\Criteria\OrderType;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Shared\Domain\Bus\Query\QueryHandler;

class SearchRentalPropertyQueryHandler implements QueryHandler
{
    public function __construct(private RentalPropertySearcherByCriteria $searcher)
    {
    }

    public function __invoke(SearchRentalPropertyQuery $query): SearchRentalPropertyResponse
    {
        $filters_array = array_reduce($query->getFilers(), function ($carry, $item) {
            $field = new FilterField($item['name']);
            $operator = FilterOperator::from($item['operator']);
            $value = new FilterValue($item['value']);
            $carry[] = new Filter($field, $operator, $value);
            return $carry;
        }, []);
        $filters = new Filters($filters_array);

        $order = new Order(
            new OrderBy($query->getOrder()['field']??'created_at'),
            OrderType::from($query->getOrder()['type']??'DESC'),
        );

        $limit = $query->getLimit();
        $offset = $query->getOffset();

        $rentalProperties = $this->searcher->__invoke($filters, $order, $limit, $offset);

        return new SearchRentalPropertyResponse(...$rentalProperties);
    }
}
