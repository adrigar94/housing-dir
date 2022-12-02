<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;
use RuntimeException;

class UserEmail extends StringValueObject
{
    protected $max_length = 254;

    protected function ensureIsValid(string $string): void
    {
        $this->ensureIsMinLengthIsValid($string);
        $this->ensureIsMaxLengthIsValid($string);
        $this->ensureIsEmailIsValid($string);
    }

    private function ensureIsEmailIsValid(string $string): void
    {
        if(!filter_var($string,FILTER_VALIDATE_EMAIL)){
            throw new RuntimeException("Email is invalid", 500);
        }
    }
}
