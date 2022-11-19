<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

enum Orientations: string
{
    case North = 'north';
    case South = 'south';
    case East = 'east';
    case West = 'west';
}
