<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

use App\Shared\Domain\ValueObject\BoolValueObject;

class PropertyConstructionCharacterisitcs
{
    public function __construct(
        private ?Rooms $rooms = null,
        private ?BathRooms $bathrooms = null,
        private ?TypesConstruction $type_construction = null,
        private ?SquareMeters $contructed_area = null,
        private ?SquareMeters $living_area = null,
        private ?SquareMeters $plot_area = null,
        private ?Age $age = null,
        private ?BuildingConservation $conservation = null,
        private ?Floor $floor = null,
        private ?OrientationsCollection $orientation = null,
        private ?BoolValueObject $has_lift = null,
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

    public function rooms($new = null): ?Rooms
    {
        if (!is_null($new)) {
            $this->rooms = $new;
        }
        return $this->rooms;
    }
    public function bathrooms($new = null): ?BathRooms
    {
        if (!is_null($new)) {
            $this->bathrooms = $new;
        }
        return $this->bathrooms;
    }
    public function typeConstruction($new = null): ?TypesConstruction
    {
        if (!is_null($new)) {
            $this->type_construction = $new;
        }
        return $this->type_construction;
    }
    public function contructedArea($new = null): ?SquareMeters
    {
        if (!is_null($new)) {
            $this->contructed_area = $new;
        }
        return $this->contructed_area;
    }
    public function livingArea($new = null): ?SquareMeters
    {
        if (!is_null($new)) {
            $this->living_area = $new;
        }
        return $this->living_area;
    }
    public function plotArea($new = null): ?SquareMeters
    {
        if (!is_null($new)) {
            $this->plot_area = $new;
        }
        return $this->plot_area;
    }
    public function age($new = null): ?Age
    {
        if (!is_null($new)) {
            $this->age = $new;
        }
        return $this->age;
    }
    public function conservation($new = null): ?BuildingConservation
    {
        if (!is_null($new)) {
            $this->conservation = $new;
        }
        return $this->conservation;
    }
    public function floor($new = null): ?Floor
    {
        if (!is_null($new)) {
            $this->floor = $new;
        }
        return $this->floor;
    }
    public function orientation($new = null): ?OrientationsCollection
    {
        if (!is_null($new)) {
            $this->orientation = $new;
        }
        return $this->orientation;
    }
    public function hasLift($new = null): ?BoolValueObject
    {
        if (!is_null($new)) {
            $this->has_lift = $new;
        }
        return $this->has_lift;
    }

    public function toArray(): array
    {
        return [
            'rooms' => $this->rooms() ? $this->rooms()->value() : null,
            'bathrooms' => $this->bathrooms() ? $this->bathrooms()->value() : null,
            'typeConstruction' => $this->typeConstruction() ? $this->typeConstruction() : null,
            'contructedArea' => $this->contructedArea() ? $this->contructedArea()->value() : null,
            'livingArea' => $this->livingArea() ? $this->livingArea()->value() : null,
            'plotArea' => $this->plotArea() ? $this->plotArea()->value() : null,
            'age' => $this->age() ? $this->age()->value() : null,
            'conservation' => $this->conservation() ? $this->conservation() : null,
            'floor' => $this->floor() ? $this->floor()->value() : null,
            'orientation' => $this->orientation() ? $this->orientation()->values() : null,
            'hasLift' => $this->hasLift() ? $this->hasLift()->value() : null,
        ];
    }

    public static function fromArray(array $value): self
    {
        $rooms = (isset($value['rooms']) and !is_null($value['rooms'])) ? new Rooms($value['rooms']) : null;
        $bathrooms = (isset($value['bathrooms']) and !is_null($value['bathrooms'])) ? new BathRooms($value['bathrooms']) : null;
        $typeConstruction = (isset($value['typeConstruction']) and !is_null($value['typeConstruction'])) ? TypesConstruction::from($value['typeConstruction']) : null;
        $contructedArea = (isset($value['contructedArea']) and !is_null($value['contructedArea'])) ? new SquareMeters($value['contructedArea']) : null;
        $livingArea = (isset($value['livingArea']) and !is_null($value['livingArea'])) ? new SquareMeters($value['livingArea']) : null;
        $plotArea = (isset($value['plotArea']) and !is_null($value['plotArea'])) ? new SquareMeters($value['plotArea']) : null;
        $age = (isset($value['age']) and !is_null($value['age'])) ? new Age($value['age']) : null;
        $conservation = (isset($value['conservation']) and !is_null($value['conservation'])) ? BuildingConservation::from($value['conservation']) : null;
        $floor = (isset($value['floor']) and !is_null($value['floor'])) ? new Floor($value['floor']) : null;
        $orientation = (isset($value['orientation']) and !is_null($value['orientation'])) ? OrientationsCollection::fromArray($value['orientation']) : null;
        $hasLift = (isset($value['hasLift']) and !is_null($value['hasLift'])) ? new BoolValueObject($value['hasLift']) : null;

        return new self($rooms, $bathrooms, $typeConstruction, $contructedArea, $livingArea, $plotArea, $age, $conservation, $floor, $orientation, $hasLift);
    }
}
