<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Age;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\BathRooms;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\BuildingConservation;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Floor;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Orientations;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\OrientationsCollection;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\PropertyConstructionCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\Rooms;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\SquareMeters;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs\TypesConstruction;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\Consumption;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\Emissions;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\EnergyEfficiencyRating;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs\PropertyEnergyCharacterisitcs;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs\PropertyEquipmentCharacterisitcs;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Shared\Domain\ValueObject\BoolMother;
use App\Tests\Shared\Domain\ValueObject\IntMother;
use App\Tests\Shared\Domain\ValueObject\RandomElementMother;

class PropertyCommonCharacteristicsMother
{
    public static function create(): PropertyCommonCharacteristics
    {
        return new PropertyCommonCharacteristics(
            new PropertyConstructionCharacterisitcs(
                new Rooms(IntMother::create(0,10)),
                new BathRooms(IntMother::create(0,10)),
                RandomElementMother::create(TypesConstruction::cases()),
                new SquareMeters(IntMother::create(10,200)),
                new SquareMeters(IntMother::create(10,200)),
                new SquareMeters(IntMother::create(10,200)),
                new Age(IntMother::create(0,100)),
                BuildingConservation::Good,
                new Floor(IntMother::create(0,10)),
                new OrientationsCollection(RandomElementMother::create(Orientations::cases()), RandomElementMother::create(Orientations::cases())),
                BoolMother::create()
            ),
            new PropertyEquipmentCharacterisitcs(
                BoolMother::create(),
                BoolMother::create(),
                BoolMother::create(),
                null, // TODO: random type of heating
                BoolMother::create(),
                BoolMother::create(),
                BoolMother::create()
            ),
            new PropertyEnergyCharacterisitcs(
                new Consumption(IntMother::create(1000,9000), RandomElementMother::create(EnergyEfficiencyRating::cases())),
                new Emissions(IntMother::create(1000,9000), RandomElementMother::create(EnergyEfficiencyRating::cases()))
            )
        );
    }
}
