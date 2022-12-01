<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Tests\Shared\Domain\ValueObject\TextMother;
use Faker\Factory;

class PropertyLocationMother
{
    public static function create(?string $country = null, ?string $region = null, ?string $city = null, ?string $address = null): PropertyLocation
    {
        $country = $country ?: Factory::create()->country();
        $region = $region ?: TextMother::create(50);
        $city = $city ?: Factory::create()->city();
        $address = $address ?: Factory::create()->address();
        
        return new PropertyLocation($country, $region, $city, $address);
    }
}
