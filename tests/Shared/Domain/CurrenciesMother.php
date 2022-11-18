<?php

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Currencies;
use Faker\Factory;

class CurrenciesMother
{
    public static function random(): Currencies
    {
        return Factory::create()->randomElement(Currencies::cases());
    }

    public static function create($symbol = null): ?Currencies
    {
        if(!$symbol){
            return self::random();
        }
        return Currencies::tryFrom($symbol);
    }
}
