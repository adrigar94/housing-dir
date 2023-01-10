<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\SearchByCriteria;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Shared\Domain\Bus\Query\Response;

final class SearchRentalPropertyResponse implements Response
{
    private array $rentalProperties;
    public function __construct(RentalProperty ...$rentalProperties)
    {
        $this->rentalProperties = $rentalProperties;
    }

    public function items(): array
    {
        return $this->rentalProperties;
    }
}
