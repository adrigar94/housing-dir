<?php

namespace App\Tests\Shared\Domain\ValueObject;

use Faker\Factory;

class RandomElementMother
{
    public static function create(array $elements)
    {
        return Factory::create()->randomElement($elements);
    }
}
