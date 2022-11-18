<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics;

final class PropertyCommonCharacteristics
{

    // private $rooms;
    // private $bathrooms;
    // private $square_metre;
    // private $type;
    // private $contructed_area;
    // private $living_area;
    // private $plot_area;
    // private $age;
    // private $conservation;
    // private $floor;
    // private $is_furnished;
    // private $has_garage;
    // private $has_lift;

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
        if($new){
            $this->constructionCharacterisitcs = $new;
        }
        return $this->constructionCharacterisitcs;
    }

    public function EquipmentCharacterisitcs(PropertyEquipmentCharacterisitcs $new = null): PropertyEquipmentCharacterisitcs
    {
        if($new){
            $this->equipmentCharacterisitcs = $new;
        }
        return $this->equipmentCharacterisitcs;
    }

    public function EnergyCharacterisitcs(PropertyEnergyCharacterisitcs $new = null): PropertyEnergyCharacterisitcs
    {
        if($new){
            $this->energyCharacterisitcs = $new;
        }
        return $this->energyCharacterisitcs;
    }

}
