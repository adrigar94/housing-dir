<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

class UserPassword extends StringValueObject
{
    protected $max_length = 254;

    static public function createFromPlainTest(string $string): self
    {
        $encrypted = self::encrypt_password($string);
        return new static($encrypted);
    }

    public function checkPlainPasswordIsSame(string $plain_password): bool
    {
        return $this->value == $this->encrypt_password($plain_password);
    }

    static private function encrypt_password(string $password): string
    {
        // TODO encrypt_password function
        return $password;
    }
}
