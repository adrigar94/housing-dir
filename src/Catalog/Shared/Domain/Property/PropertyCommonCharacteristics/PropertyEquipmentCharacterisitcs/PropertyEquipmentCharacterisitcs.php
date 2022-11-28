<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs;

use App\Shared\Domain\ValueObject\BoolValueObject;

class PropertyEquipmentCharacterisitcs
{
    public function __construct(
        private BoolValueObject $is_furnished,
        private BoolValueObject $has_garage,
        private BoolValueObject $has_heating,
        private ?TypesHeating $type_heating,
        private BoolValueObject $has_air_conditioning,
        private BoolValueObject $has_garden,
        private BoolValueObject $has_pool
    ) {
        $this->is_furnished = $is_furnished;
        $this->has_garage = $has_garage;
        $this->has_heating = $has_heating;
        $this->type_heating = $type_heating ?? TypesHeating::Other;
        $this->has_air_conditioning = $has_air_conditioning;
        $this->has_garden = $has_garden;
        $this->has_pool = $has_pool;
    }

    public function isFurnished($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->is_furnished = $new;
        }
        return $this->is_furnished;
    }

    public function hasGarage($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_garage = $new;
        }
        return $this->has_garage;
    }

    public function hasHeating($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_heating = $new;
        }
        return $this->has_heating;
    }

    public function typeHeating($new = null): TypesHeating
    {
        if (!is_null($new)) {
            $this->type_heating = $new;
        }
        return $this->type_heating;
    }

    public function hasAirConditioning($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_air_conditioning = $new;
        }
        return $this->has_air_conditioning;
    }

    public function hasGarden($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_garden = $new;
        }
        return $this->has_garden;
    }

    public function hasPool($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_pool = $new;
        }
        return $this->has_pool;
    }

    public function toArray(): array
    {
        return [
            'isFurnished' => $this->isFurnished()->value(),
            'hasGarage' => $this->hasGarage()->value(),
            'hasHeating' => $this->hasHeating()->value(),
            'typeHeating' => $this->typeHeating(),
            'hasAirConditioning' => $this->hasAirConditioning()->value(),
            'hasGarden' => $this->hasGarden()->value(),
            'hasPool' => $this->hasPool()->value(),
        ];
    }

    public static function fromArray(array $value): self
    {
        $isFurnished = new BoolValueObject($value['isFurnished']);
        $hasGarage = new BoolValueObject($value['hasGarage']);
        $hasHeating = new BoolValueObject($value['hasHeating']);
        $typeHeating = TypesHeating::from($value['typeHeating']);
        $hasAirConditioning = new BoolValueObject($value['hasAirConditioning']);
        $hasGarden = new BoolValueObject($value['hasGarden']);
        $hasPool = new BoolValueObject($value['hasPool']);
        return new static($isFurnished, $hasGarage, $hasHeating, $typeHeating, $hasAirConditioning, $hasGarden, $hasPool);
    }
}
