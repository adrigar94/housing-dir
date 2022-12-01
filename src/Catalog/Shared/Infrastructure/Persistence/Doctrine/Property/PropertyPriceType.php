<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Catalog\Shared\Domain\Property\PropertyPrice;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class PropertyPriceType extends JsonType
{
    const TYPE = 'property_price';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PropertyPrice
    {
        $value = json_decode($value??[], true, 512, JSON_THROW_ON_ERROR);
        return PropertyPrice::fromArray($value);
    }
}
