<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\PropertyConstructionCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\PropertyEnergyCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs\PropertyEquipmentCharacterisitcs;

final class PropertyCommonCharacteristics
{

    private $constructionCharacterisitcs;
    private $equipmentCharacterisitcs;
    private $energyCharacterisitcs;

    public function __construct(
        PropertyConstructionCharacterisitcs $constructionCharacterisitcs,
        PropertyEquipmentCharacterisitcs $equipmentCharacterisitcs,
        PropertyEnergyCharacterisitcs $energyCharacterisitcs,
    )
    {
        $this->constructionCharacterisitcs = $constructionCharacterisitcs;
        $this->equipmentCharacterisitcs = $equipmentCharacterisitcs;
        $this->energyCharacterisitcs = $energyCharacterisitcs;
    }

    public function ConstructionCharacterisitcs(PropertyConstructionCharacterisitcs $new = null): PropertyConstructionCharacterisitcs
    {
        if(!is_null($new)){
            $this->constructionCharacterisitcs = $new;
        }
        return $this->constructionCharacterisitcs;
    }

    public function EquipmentCharacterisitcs(PropertyEquipmentCharacterisitcs $new = null): PropertyEquipmentCharacterisitcs
    {
        if(!is_null($new)){
            $this->equipmentCharacterisitcs = $new;
        }
        return $this->equipmentCharacterisitcs;
    }

    public function EnergyCharacterisitcs(PropertyEnergyCharacterisitcs $new = null): PropertyEnergyCharacterisitcs
    {
        if(!is_null($new)){
            $this->energyCharacterisitcs = $new;
        }
        return $this->energyCharacterisitcs;
    }

}
