<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Catalog\Shared\Domain\Property\PropertyTitle;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class PropertyTitleType extends StringType
{
    const TYPE = 'property_title';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PropertyTitle
    {
        return new PropertyTitle($value);
    }
}
