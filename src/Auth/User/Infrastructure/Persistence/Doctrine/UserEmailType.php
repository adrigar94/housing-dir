<?php

namespace App\Auth\User\Infrastructure\Persistence\Doctrine;

use App\Auth\User\Domain\UserEmail;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UserEmailType extends StringType
{
    const TYPE = 'user_email';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserEmail
    {
        return new UserEmail($value);
    }
}
