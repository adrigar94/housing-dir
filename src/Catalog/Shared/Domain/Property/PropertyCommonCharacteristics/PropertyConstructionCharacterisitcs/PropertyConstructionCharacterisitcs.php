<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

use App\Shared\Domain\ValueObject\BoolValueObject;

class PropertyConstructionCharacterisitcs
{
    public function __construct(
        private Rooms $rooms,
        private BathRooms $bathrooms,
        private TypesConstruction $type_construction,
        private SquareMeters $contructed_area,
        private SquareMeters $living_area,
        private SquareMeters $plot_area,
        private Age $age,
        private BuildingConservation $conservation,
        private Floor $floor,
        private OrientationsCollection $orientation,
        private BoolValueObject $has_lift,
    ) {
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

    public function rooms($new = null): Rooms
    {
        if (!is_null($new)) {
            $this->rooms = $new;
        }
        return $this->rooms;
    }
    public function bathrooms($new = null): BathRooms
    {
        if (!is_null($new)) {
            $this->bathrooms = $new;
        }
        return $this->bathrooms;
    }
    public function typeConstruction($new = null): TypesConstruction
    {
        if (!is_null($new)) {
            $this->type_construction = $new;
        }
        return $this->type_construction;
    }
    public function contructedArea($new = null): SquareMeters
    {
        if (!is_null($new)) {
            $this->contructed_area = $new;
        }
        return $this->contructed_area;
    }
    public function livingArea($new = null): SquareMeters
    {
        if (!is_null($new)) {
            $this->living_area = $new;
        }
        return $this->living_area;
    }
    public function plotArea($new = null): SquareMeters
    {
        if (!is_null($new)) {
            $this->plot_area = $new;
        }
        return $this->plot_area;
    }
    public function age($new = null): Age
    {
        if (!is_null($new)) {
            $this->age = $new;
        }
        return $this->age;
    }
    public function conservation($new = null): BuildingConservation
    {
        if (!is_null($new)) {
            $this->conservation = $new;
        }
        return $this->conservation;
    }
    public function floor($new = null): Floor
    {
        if (!is_null($new)) {
            $this->floor = $new;
        }
        return $this->floor;
    }
    public function orientation($new = null): OrientationsCollection
    {
        if (!is_null($new)) {
            $this->orientation = $new;
        }
        return $this->orientation;
    }
    public function hasLift($new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_lift = $new;
        }
        return $this->has_lift;
    }

    public function toArray(): array
    {
        return [
            'rooms' => $this->rooms()->value(),
            'bathrooms' => $this->bathrooms()->value(),
            'typeConstruction' => $this->typeConstruction(),
            'contructedArea' => $this->contructedArea()->value(),
            'livingArea' => $this->livingArea()->value(),
            'plotArea' => $this->plotArea()->value(),
            'age' => $this->age()->value(),
            'conservation' => $this->conservation(),
            'floor' => $this->floor()->value(),
            'orientation' => $this->orientation()->values(),
            'hasLift' => $this->hasLift()->value(),
        ];
    }

    public static function fromArray(array $value): self
    {
        $rooms = new Rooms($value['rooms']);
        $bathrooms = new BathRooms($value['bathrooms']);
        $typeConstruction = TypesConstruction::from($value['typeConstruction']);
        $contructedArea = new SquareMeters($value['contructedArea']);
        $livingArea = new SquareMeters($value['livingArea']);
        $plotArea = new SquareMeters($value['plotArea']);
        $age = new Age($value['age']);
        $conservation = BuildingConservation::from($value['conservation']);
        $floor = new Floor($value['floor']);
        $orientation = OrientationsCollection::fromArray($value['orientation']);
        $hasLift = new BoolValueObject($value['hasLift']);

        return new static($rooms, $bathrooms, $typeConstruction, $contructedArea, $livingArea, $plotArea, $age, $conservation, $floor, $orientation, $hasLift);
    }
}
