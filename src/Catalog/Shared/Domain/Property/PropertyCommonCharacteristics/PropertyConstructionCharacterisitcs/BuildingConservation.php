<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

enum BuildingConservation: string
{
    case NewHome = 'new_home';
    case Good = 'good';
    case NeedRenovating = 'need_renovating';
}
