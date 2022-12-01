<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\PropertyConstructionCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\PropertyEnergyCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs\PropertyEquipmentCharacterisitcs;
use JsonSerializable;

final class PropertyCommonCharacteristics implements JsonSerializable
{
    public function __construct(
        private ?PropertyConstructionCharacterisitcs $constructionCharacterisitcs = null,
        private ?PropertyEquipmentCharacterisitcs $equipmentCharacterisitcs = null,
        private ?PropertyEnergyCharacterisitcs $energyCharacterisitcs = null,
    ) {
        $this->constructionCharacterisitcs = $constructionCharacterisitcs;
        $this->equipmentCharacterisitcs = $equipmentCharacterisitcs;
        $this->energyCharacterisitcs = $energyCharacterisitcs;
    }

    public function constructionCharacterisitcs(PropertyConstructionCharacterisitcs $new = null): ?PropertyConstructionCharacterisitcs
    {
        if (!is_null($new)) {
            $this->constructionCharacterisitcs = $new;
        }
        return $this->constructionCharacterisitcs;
    }

    public function equipmentCharacterisitcs(PropertyEquipmentCharacterisitcs $new = null): ?PropertyEquipmentCharacterisitcs
    {
        if (!is_null($new)) {
            $this->equipmentCharacterisitcs = $new;
        }
        return $this->equipmentCharacterisitcs;
    }

    public function energyCharacterisitcs(PropertyEnergyCharacterisitcs $new = null): ?PropertyEnergyCharacterisitcs
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
        return [
            'constructionCharacterisitcs' => $this->constructionCharacterisitcs() ? $this->constructionCharacterisitcs()->toArray() : null,
            'equipmentCharacterisitcs' => $this->equipmentCharacterisitcs() ? $this->equipmentCharacterisitcs()->toArray() : null,
            'energyCharacterisitcs' => $this->energyCharacterisitcs() ? $this->energyCharacterisitcs()->toArray() : null,
        ];
    }

    public static function fromArray(array $value): self
    {
        $constructionCharacterisitcs = isset($value['constructionCharacterisitcs']) ? PropertyConstructionCharacterisitcs::fromArray($value['constructionCharacterisitcs'] ?? []) : null;
        $equipmentCharacterisitcs = isset($value['equipmentCharacterisitcs']) ? PropertyEquipmentCharacterisitcs::fromArray($value['equipmentCharacterisitcs'] ?? []) : null;
        $energyCharacterisitcs = isset($value['energyCharacterisitcs']) ? PropertyEnergyCharacterisitcs::fromArray($value['energyCharacterisitcs'] ?? []) : null;

        return new static($constructionCharacterisitcs, $equipmentCharacterisitcs, $energyCharacterisitcs);
    }
}
