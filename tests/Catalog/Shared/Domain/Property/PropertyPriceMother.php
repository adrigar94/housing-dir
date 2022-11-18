<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Tests\Shared\Domain\CurrenciesMother;
use App\Tests\Shared\Domain\ValueObject\IntMother;

class PropertyPriceMother
{
    public static function create(?string $value = null, ?string $symbol = null): PropertyPrice
    {
        return new PropertyPrice(($value ?? IntMother::create(0, 3000)), CurrenciesMother::create($symbol));
    }
}
