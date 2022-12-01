<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Catalog\Shared\Domain\Property\PropertyLocation;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class PropertyLocationType extends JsonType
{

    const TYPE = 'property_location';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PropertyLocation
    {
        $value = json_decode($value??[], true, 512, JSON_THROW_ON_ERROR);
        return PropertyLocation::fromArray($value);
    }

}
