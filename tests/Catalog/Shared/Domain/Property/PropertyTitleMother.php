<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Tests\Shared\Domain\ValueObject\TextMother;

class PropertyTitleMother
{
    public static function create(?string $value = null): PropertyTitle
    {
        return new PropertyTitle($value ?? TextMother::create(50));
    }
}
