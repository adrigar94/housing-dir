<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Catalog\Shared\Domain\Property\PropertyDescription;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class PropertyDescriptionType extends StringType
{
    const TYPE = 'property_description';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PropertyDescription
    {
        return new PropertyDescription($value);
    }
}
