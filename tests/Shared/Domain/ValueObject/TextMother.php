<?php

namespace App\Tests\Shared\Domain\ValueObject;

use Faker\Factory;

class TextMother
{
    public static function create(int $characters = 200): string
    {
        return Factory::create()->text($characters);
    }
}
