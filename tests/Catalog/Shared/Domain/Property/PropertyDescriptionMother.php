<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Tests\Shared\Domain\ValueObject\TextMother;

class PropertyDescriptionMother
{
    public static function create(?string $value = null): PropertyDescription
    {
        return new PropertyDescription($value ?? TextMother::create(2048));
    }
}
