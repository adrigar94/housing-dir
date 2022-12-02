<?php

namespace App\Auth\User\Infrastructure\Persistence\Doctrine;

use App\Auth\User\Domain\UserPassword;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UserPasswordType extends StringType
{
    const TYPE = 'user_password';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserPassword
    {
        return new UserPassword($value);
    }
}
