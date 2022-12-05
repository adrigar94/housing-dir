<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

class UserPassword extends StringValueObject
{
    protected $max_length = 254;

    static public function createFromPlainTest(string $string): self
    {
        $encrypted = password_hash($string, PASSWORD_BCRYPT);
        return new static($encrypted);
    }

    public function checkPlainPasswordIsSame(string $plain_password): bool
    {
        return password_verify($plain_password, $this->value);
    }
}
