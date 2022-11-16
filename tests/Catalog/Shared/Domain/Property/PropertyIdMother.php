<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Tests\Shared\Domain\ValueObject\UuidMother;

class PropertyIdMother
{
    public static function create(?string $value = null): PropertyId
    {
        return new PropertyId($value ?? UuidMother::create());
    }
}
