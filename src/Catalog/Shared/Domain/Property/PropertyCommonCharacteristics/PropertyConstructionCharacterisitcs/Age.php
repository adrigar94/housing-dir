<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

use App\Shared\Domain\ValueObject\IntValueObject;

class Age extends IntValueObject
{
    protected $min_int = 0;
}
