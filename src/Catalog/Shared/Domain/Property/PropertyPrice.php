<?php

namespace App\Catalog\Shared\Domain\Property;

use App\Shared\Domain\Currencies;
use Exception;
use JsonSerializable;

class PropertyPrice implements JsonSerializable
{
    public function __construct(private int $price_cents, private Currencies $currency)
    {
        $this->price_cents = $price_cents;
        $this->currency = $currency;
    }

    public function priceCents(): int
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
        if ($symbol_after) {
            return $this->price . " " . $this->currency->value;
        }
        return $this->currency->value . " " . $this->price;
    }

    public static function fromArray(array $value): self
    {
        $price_cents = $value['price_cents'] ?? throw new Exception("Missing parameter price_cent in price", 500);
        $currency = $value['currency'] ?? throw new Exception("Missing parameter currency in price", 500);
        
        return new static($price_cents, Currencies::from($currency));
    }

    public function toArray(): array
    {
        return [
            'price_cents' => $this->priceCents(),
            'currency' => $this->currency(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
