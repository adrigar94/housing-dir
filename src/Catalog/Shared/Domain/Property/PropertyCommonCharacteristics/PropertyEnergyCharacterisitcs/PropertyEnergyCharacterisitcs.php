<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs;

class PropertyEnergyCharacterisitcs
{
    private $consumption;
    private $emissions;
    // TODO: generate label of energy certificate
    
    public function __construct(
        Consumption $consumption,
        Emissions $emissions
    ){
        $this->consumption = $consumption;
        $this->emissions = $emissions;
    }

    public function Consumption(): Consumption
    {
        return $this->consumption;
    }

    public function Emissions(): Emissions
    {
        return $this->emissions;
    }
}
