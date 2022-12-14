<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs;

enum EnergyEfficiencyRating: string
{
    case A = 'a';
    case B = 'b';
    case C = 'c';
    case D = 'd';
    case E = 'e';
    case F = 'f';
    case G = 'g';
    case InProcess = 'in_process';
    case Exempt = 'exempt';
    case NotAvaible = 'not_avaible';
}
