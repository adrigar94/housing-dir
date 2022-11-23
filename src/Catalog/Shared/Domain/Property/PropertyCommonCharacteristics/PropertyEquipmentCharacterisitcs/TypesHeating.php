<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEquipmentCharacterisitcs;

enum TypesHeating: string
{
    case GasCentral = 'gas_central';
    case DieselCentral = 'diesel_central';
    case OtherCentral = 'other_central';
    case NaturalGas = 'natural_gas';
    case PropaneOrButaneGas = 'propane_or_butane_gas';
    case Electric = 'electric';
    case HeatPump = 'heat_pump';
    case Other = 'other';
}
