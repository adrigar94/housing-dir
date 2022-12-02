<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Shared\Domain\ValueObject\BoolValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BooleanType;

class PropertyPetsAllowedType extends BooleanType
{
    const TYPE = 'property_pets_allowed';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?BoolValueObject
    {
        return is_null($value)?null:new BoolValueObject($value);
    }
}
