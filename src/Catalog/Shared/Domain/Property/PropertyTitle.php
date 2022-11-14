<?php

namespace App\Catalog\Shared\Domain\Property;

use App\Shared\Domain\ValueObject\StringValueObject;

final class PropertyTitle extends StringValueObject
{
    protected $min_length = 5;
    protected $max_length = 70;
}
