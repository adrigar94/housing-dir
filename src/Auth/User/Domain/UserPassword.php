<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

class UserPassword extends StringValueObject
{
    private static $min_length_plain_text = 6;

    static public function createFromPlainTest(string $string): self
    {
        if(strlen($string)<self::$min_length_plain_text){
            throw new InvalidUserPasswordMinLengthException();
        }

        $encrypted = password_hash($string, PASSWORD_BCRYPT);
        return new static($encrypted);
    }

    public function checkPlainPasswordIsSame(string $plain_password): bool
    {
        return password_verify($plain_password, $this->value);
    }
}
