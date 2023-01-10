<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\SearchByCriteria;

use App\Shared\Domain\Bus\Query\Query;

class SearchRentalPropertyQuery implements Query
{
    /**
     * Summary of __construct
     * @param array $filers [ ['name'=>'field_name', 'operator'=>'=', 'value'=>'...'], ]
     * @param array $order [ 'field'=>'field_name', 'type'=>'DESC' ]
     * @param int|null $offset
     * @param int|null $limit
     */
    public function __construct(
        private array $filers,
        private array $order,
        private ?int $offset = null,
        private ?int $limit = null
    ) {
    }
    public function getFilers(): array
    {
        return $this->filers;
    }

    public function getOrder(): array
    {
        return $this->order;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }
}
