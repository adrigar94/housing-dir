<?php

namespace App\Catalog\Shared\Domain\Property;

use App\Shared\Domain\Currencies;
use Stringable;

class PropertyPrice
{
    private $price_cents;
    private $currency;

    public function __construct(int $price_cents, Currencies $currency)
    {
        $this->price_cents = $price_cents;
        $this->currency = $currency;
    }

    public function price_cents(): int
    {
        return $this->price_cents;
    }

    public function price(): float
    {
        return $this->price_cents * 100;
    }

    public function currency(): Currencies
    {
        return $this->currency;
    }

    public function toString($symbol_after = false): string
    {
        if($symbol_after){
            return $this->price . " " . $this->currency->value;
        }
        return $this->currency->value . " " . $this->price;
    }
    
}