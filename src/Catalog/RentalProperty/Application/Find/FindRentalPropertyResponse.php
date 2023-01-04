<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Find;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Shared\Domain\Bus\Query\Response;

final class FindRentalPropertyResponse implements Response
{
    public function __construct(private RentalProperty $rentalProperty)
    {
    }

    public function value(): array
    {
        return $this->rentalProperty->toArray();
    }
}