<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs;

use App\Shared\Domain\ValueObject\IntValueObject;
use Stringable;

/**
 * Consumtion in Whats-hour / meter^2
 */
class Consumption extends IntValueObject implements Stringable
{
    protected $min_int = 0;

    /**
     * @param int $value Consumtion in Whats-hour / meter²
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

    public function KWhPerMeter2(): int
    {
        return $this->value / 1000;
    }

    public function __toString(): string
    {
        return $this->KWhPerMeter2() . ' KWh/m² year';
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value(),
            'rating' => $this->rating()
        ];
    }

    public static function fromArray(array $value): self
    {
        $rating = EnergyEfficiencyRating::from($value['rating']);
        return new self($value['value'],$rating);
    }
}
