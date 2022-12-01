<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs;

use App\Shared\Domain\ValueObject\BoolValueObject;

class PropertyEquipmentCharacterisitcs
{
    public function __construct(
        private ?BoolValueObject $is_furnished = null,
        private ?BoolValueObject $has_garage = null,
        private ?BoolValueObject $has_heating = null,
        private ?TypesHeating $type_heating = null,
        private ?BoolValueObject $has_air_conditioning = null,
        private ?BoolValueObject $has_garden = null,
        private ?BoolValueObject $has_pool = null
    ) {
        $this->is_furnished = $is_furnished;
        $this->has_garage = $has_garage;
        $this->has_heating = $has_heating;
        $this->type_heating = $type_heating;
        $this->has_air_conditioning = $has_air_conditioning;
        $this->has_garden = $has_garden;
        $this->has_pool = $has_pool;
    }

    public function isFurnished($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->is_furnished = $new;
        }
        return $this->is_furnished;
    }

    public function hasGarage($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_garage = $new;
        }
        return $this->has_garage;
    }

    public function hasHeating($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_heating = $new;
        }
        return $this->has_heating;
    }

    public function typeHeating($new = null): ?TypesHeating
    {
        if (!is_null($new)) {
            $this->type_heating = $new;
        }
        return $this->type_heating;
    }

    public function hasAirConditioning($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_air_conditioning = $new;
        }
        return $this->has_air_conditioning;
    }

    public function hasGarden($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_garden = $new;
        }
        return $this->has_garden;
    }

    public function hasPool($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_pool = $new;
        }
        return $this->has_pool;
    }

    public function toArray(): array
    {
        return [
            'isFurnished' => $this->isFurnished() ? $this->isFurnished()->value() : null,
            'hasGarage' => $this->hasGarage() ? $this->hasGarage()->value() : null,
            'hasHeating' => $this->hasHeating() ? $this->hasHeating()->value() : null,
            'typeHeating' => $this->typeHeating() ? $this->typeHeating() : null,
            'hasAirConditioning' => $this->hasAirConditioning() ? $this->hasAirConditioning()->value() : null,
            'hasGarden' => $this->hasGarden() ? $this->hasGarden()->value() : null,
            'hasPool' => $this->hasPool() ? $this->hasPool()->value() : null,
        ];
    }

    public static function fromArray(array $value): self
    {
        $isFurnished = (isset($value['isFurnished']) and !is_null($value['isFurnished'])) ? new BoolValueObject($value['isFurnished']) : null;
        $hasGarage = (isset($value['hasGarage']) and !is_null($value['hasGarage'])) ? new BoolValueObject($value['hasGarage']) : null;
        $hasHeating = (isset($value['hasHeating']) and !is_null($value['hasHeating'])) ? new BoolValueObject($value['hasHeating']) : null;
        $typeHeating = (isset($value['typeHeating']) and !is_null($value['typeHeating'])) ? TypesHeating::from($value['typeHeating']) : null;
        $hasAirConditioning = (isset($value['hasAirConditioning']) and !is_null($value['hasAirConditioning'])) ? new BoolValueObject($value['hasAirConditioning']) : null;
        $hasGarden = (isset($value['hasGarden']) and !is_null($value['hasGarden'])) ? new BoolValueObject($value['hasGarden']) : null;
        $hasPool = (isset($value['hasPool']) and !is_null($value['hasPool'])) ? new BoolValueObject($value['hasPool']) : null;
        return new static($isFurnished, $hasGarage, $hasHeating, $typeHeating, $hasAirConditioning, $hasGarden, $hasPool);
    }
}
