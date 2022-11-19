<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

use App\Shared\Domain\ValueObject\IntValueObject;

class Floor extends IntValueObject
{
    protected $min_int = 0;
    protected $max_int = 200;
}
