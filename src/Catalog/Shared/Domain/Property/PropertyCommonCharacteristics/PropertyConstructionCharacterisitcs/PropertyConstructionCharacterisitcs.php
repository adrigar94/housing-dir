<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

use App\Shared\Domain\ValueObject\BoolValueObject;

class PropertyConstructionCharacterisitcs
{
    private $rooms;
    private $bathrooms;
    private $type_construction;
    private $contructed_area;
    private $living_area;
    private $plot_area;
    private $age;
    private $conservation;
    private $floor;
    private $orientation;
    private $has_lift;

    public function __construct(
        Rooms $rooms,
        BathRooms $bathrooms,
        TypesConstruction $type_construction,
        SquareMeters $contructed_area,
        SquareMeters $living_area,
        SquareMeters $plot_area,
        Age $age,
        BuildingConservation $conservation,
        Floor $floor,
        OrientationsCollection $orientation,
        BoolValueObject $has_lift,
    )
    {
        $this->rooms = $rooms;
        $this->bathrooms = $bathrooms;
        $this->type_construction = $type_construction;
        $this->contructed_area = $contructed_area;
        $this->living_area = $living_area;
        $this->plot_area = $plot_area;
        $this->age = $age;
        $this->conservation = $conservation;
        $this->floor = $floor;
        $this->orientation = $orientation;
        $this->has_lift = $has_lift;
    }

    public function rooms($new=null): Rooms
    {
        if(!is_null($new)){
            $this->rooms = $new;
        }
        return $this->rooms;
    }
    public function bathrooms($new=null): BathRooms
    {
        if(!is_null($new)){
            $this->bathrooms = $new;
        }
        return $this->bathrooms;
    }
    public function type_construction($new=null): TypesConstruction
    {
        if(!is_null($new)){
            $this->type_construction = $new;
        }
        return $this->type_construction;
    }
    public function contructed_area($new=null): SquareMeters
    {
        if(!is_null($new)){
            $this->contructed_area = $new;
        }
        return $this->contructed_area;
    }
    public function living_area($new=null): SquareMeters
    {
        if(!is_null($new)){
            $this->living_area = $new;
        }
        return $this->living_area;
    }
    public function plot_area($new=null): SquareMeters
    {
        if(!is_null($new)){
            $this->plot_area = $new;
        }
        return $this->plot_area;
    }
    public function age($new=null): Age
    {
        if(!is_null($new)){
            $this->age = $new;
        }
        return $this->age;
    }
    public function conservation($new=null): BuildingConservation
    {
        if(!is_null($new)){
            $this->conservation = $new;
        }
        return $this->conservation;
    }
    public function floor($new=null): Floor
    {
        if(!is_null($new)){
            $this->floor = $new;
        }
        return $this->floor;
    }
    public function orientation($new=null): Orientations
    {
        if(!is_null($new)){
            $this->orientation = $new;
        }
        return $this->orientation;
    }
    public function has_lift($new=null): BoolValueObject
    {
        if(!is_null($new)){
            $this->has_lift = $new;
        }
        return $this->has_lift;
    }
}