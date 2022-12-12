<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\InvalidStringValueObjectMinLengthException;

final class InvalidUserPasswordMinLengthException extends InvalidStringValueObjectMinLengthException
{
    public const Message = "Password does not have the required minimum length";

    
    public function __construct()
    {
        parent::__construct(self::Message,self::Code);
    }
}
