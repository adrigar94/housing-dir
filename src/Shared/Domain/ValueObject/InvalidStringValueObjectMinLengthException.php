<?php

namespace App\Shared\Domain\ValueObject;

use DomainException;

class InvalidStringValueObjectMinLengthException extends DomainException
{
    public const Message = "String does not have the required minimum length";
    public const Code = 400;

    public function __construct($message = self::Message,$code=self::Code)
    {
        parent::__construct($message,$code);
    }
}
