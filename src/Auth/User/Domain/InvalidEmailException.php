<?php

namespace App\Auth\User\Domain;

use DomainException;

class InvalidEmailException extends DomainException
{
    public const Message = "Email is invalid";
    public const Code = 400;

    public function __construct()
    {
        parent::__construct(self::Message,self::Code);
    }
}