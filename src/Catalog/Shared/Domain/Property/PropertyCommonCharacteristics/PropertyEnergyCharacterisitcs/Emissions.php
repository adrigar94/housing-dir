<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs;

use App\Shared\Domain\ValueObject\IntValueObject;
use Stringable;

class Emissions extends IntValueObject implements Stringable
{
    protected $min_int = 0;

    /**
     * @param int $value Emissions in g CO2/m²
     */
    public function __construct(int $value, private EnergyEfficiencyRating $rating)
    {
        $this->ensureIsValid($value);
        $this->value = $value;
        $this->rating = $rating;
    }

    public function rating(): EnergyEfficiencyRating
    {
        return $this->rating;
    }

    public function kGCO2PerMeter2(): int
    {
        return $this->value / 1000;
    }

    public function __toString(): string
    {
        return $this->kGCO2PerMeter2() . " KG CO2/m²";
    }
}
