<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyConstructionCharacterisitcs;

enum TypesConstruction: string
{
    case Home = 'home';
    case Room = 'room';
    case Office = 'office';
    case Commercial = 'commercial';
    case Garage = 'garage';
    case Land = 'land';
    case StorageRoom = 'storage_room';
    case Building = 'building';
}
