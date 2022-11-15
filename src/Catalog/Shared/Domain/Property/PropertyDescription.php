<?php

namespace App\Catalog\Shared\Domain\Property;

use App\Shared\Domain\ValueObject\StringValueObject;

final class PropertyDescription extends StringValueObject
{
    protected $min_length = 5;
    protected $max_length = 5120;
}
