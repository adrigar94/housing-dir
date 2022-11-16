<?php

namespace App\Tests\Shared\Domain\ValueObject;

use Faker\Factory;

class UuidMother
{
    public static function create(): string
    {
        return Factory::create()->unique()->uuid();
    }
}
