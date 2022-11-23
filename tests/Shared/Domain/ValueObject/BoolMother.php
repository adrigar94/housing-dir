<?php

namespace App\Tests\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\BoolValueObject;
use Faker\Factory;

class BoolMother
{
    public static function create(): BoolValueObject
    {
        return new BoolValueObject(Factory::create()->boolean());
    }
}
