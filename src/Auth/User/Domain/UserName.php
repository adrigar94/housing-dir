<?php

namespace App\Auth\User\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

class UserName extends StringValueObject
{
    protected $max_length = 254;
}
