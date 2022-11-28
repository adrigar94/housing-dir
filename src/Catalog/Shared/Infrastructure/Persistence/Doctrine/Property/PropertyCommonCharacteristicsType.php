<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class PropertyCommonCharacteristicsType extends JsonType
{

    const TYPE = 'property_common_characteristics';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PropertyCommonCharacteristics
    {
        $value = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        return PropertyCommonCharacteristics::fromArray($value);
    }
}
