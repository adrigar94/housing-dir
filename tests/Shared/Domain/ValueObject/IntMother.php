<?php

namespace App\Tests\Shared\Domain\ValueObject;

use Faker\Factory;

class IntMother
{
    public static function create($min = PHP_INT_MIN, $max = PHP_INT_MAX): string
    {
        return Factory::create()->numberBetween($min, $max);
    }
}
