<?php

namespace App\Tests\Shared\Domain\ValueObject;

use Faker\Factory;

class IntMother
{
    public static function create(int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): string
    {
        return Factory::create()->numberBetween($min, $max);
    }
}
