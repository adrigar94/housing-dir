<?php

namespace App\Auth\User\Infrastructure\Persistence\Doctrine;

use App\Auth\User\Domain\UserName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UserNameType extends StringType
{
    const TYPE = 'user_name';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserName
    {
        return new UserName($value);
    }
}
