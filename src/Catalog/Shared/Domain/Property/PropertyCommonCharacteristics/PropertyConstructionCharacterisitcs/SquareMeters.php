<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

use App\Shared\Domain\ValueObject\IntValueObject;
use Stringable;

class SquareMeters extends IntValueObject implements Stringable
{
    protected $min_int = 0;

    public function hectares(): float
    {
        return $this->value / 10000;
    }

    public function __toString(): string
    {
        if ($this->value > 10000) {
            return round($this->hectares(), 2) . 'ha';
        }
        return $this->value . 'm²';
    }
}
