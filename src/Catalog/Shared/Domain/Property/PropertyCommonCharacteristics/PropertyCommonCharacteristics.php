<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\PropertyConstructionCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\PropertyEnergyCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs\PropertyEquipmentCharacterisitcs;
use JsonSerializable;

final class PropertyCommonCharacteristics implements JsonSerializable
{
    public function __construct(
        private PropertyConstructionCharacterisitcs $constructionCharacterisitcs,
        private PropertyEquipmentCharacterisitcs $equipmentCharacterisitcs,
        private PropertyEnergyCharacterisitcs $energyCharacterisitcs,
    ) {
        $this->constructionCharacterisitcs = $constructionCharacterisitcs;
        $this->equipmentCharacterisitcs = $equipmentCharacterisitcs;
        $this->energyCharacterisitcs = $energyCharacterisitcs;
    }

    public function ConstructionCharacterisitcs(PropertyConstructionCharacterisitcs $new = null): PropertyConstructionCharacterisitcs
    {
        if (!is_null($new)) {
            $this->constructionCharacterisitcs = $new;
        }
        return $this->constructionCharacterisitcs;
    }

    public function EquipmentCharacterisitcs(PropertyEquipmentCharacterisitcs $new = null): PropertyEquipmentCharacterisitcs
    {
        if (!is_null($new)) {
            $this->equipmentCharacterisitcs = $new;
        }
        return $this->equipmentCharacterisitcs;
    }

    public function EnergyCharacterisitcs(PropertyEnergyCharacterisitcs $new = null): PropertyEnergyCharacterisitcs
    {
        if (!is_null($new)) {
            $this->energyCharacterisitcs = $new;
        }
        return $this->energyCharacterisitcs;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
    private function toArray(): array
    {
        return ['TODO']; //TODO method toArray
    }

    // TODO method fromArray
    // public static function fromArray(array $value): self
    // {
    //     return new static();
    // }
}
