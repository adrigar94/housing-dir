<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs;

use App\Shared\Domain\ValueObject\BoolValueObject;

class PropertyEquipmentCharacterisitcs
{
    private $is_furnished;
    private $has_garage;
    private $has_heating;
    private $has_air_conditioning;
    private $has_garden;

    public function __construct(
        BoolValueObject $is_furnished,
        BoolValueObject $has_garage,
        BoolValueObject $has_heating,
        BoolValueObject $has_air_conditioning,
        BoolValueObject $has_garden,
        BoolValueObject $has_pool
    )
    {
        $this->is_furnished = $is_furnished;
        $this->has_garage = $has_garage;
        $this->has_heating = $has_heating;
        $this->has_air_conditioning = $has_air_conditioning;
        $this->has_garden = $has_garden;
        $this->has_pool = $has_pool;
    }

    public function IsFurnished($new = null): BoolValueObject
    {
        if(!is_null($new)){
            $this->is_furnished = $new;
        }
        return $this->is_furnished;
    }

    public function HasGarage($new = null): BoolValueObject
    {
        if(!is_null($new)){
            $this->has_garage = $new;
        }
        return $this->has_garage;
    }

    public function HasHeating($new = null): BoolValueObject
    {
        if(!is_null($new)){
            $this->has_heating = $new;
        }
        return $this->has_heating;
    }

    public function HasAirConditioning($new = null): BoolValueObject
    {
        if(!is_null($new)){
            $this->has_air_conditioning = $new;
        }
        return $this->has_air_conditioning;
    }

    public function HasGarden($new = null): BoolValueObject
    {
        if(!is_null($new)){
            $this->has_garden = $new;
        }
        return $this->has_garden;
    }

    public function HasPool($new = null): BoolValueObject
    {
        if(!is_null($new)){
            $this->has_pool = $new;
        }
        return $this->has_pool;
    }

}
