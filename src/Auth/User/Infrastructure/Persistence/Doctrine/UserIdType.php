<?php

namespace App\Auth\User\Infrastructure\Persistence\Doctrine;

use App\Auth\User\Domain\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class UserIdType extends GuidType
{
    const TYPE = 'user_id';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserId
    {
        return new UserId($value);
    }
}
