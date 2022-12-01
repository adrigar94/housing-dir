<?php

namespace App\Catalog\Shared\Infrastructure\Persistence\Doctrine\Property;

use App\Catalog\Shared\Domain\Property\PropertyGallery;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

class PropertyGalleryType extends JsonType
{
    const TYPE = 'property_gallery';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): PropertyGallery
    {
        $value = json_decode($value??[], true, 512, JSON_THROW_ON_ERROR);
        return PropertyGallery::fromArray($value);
    }
}
