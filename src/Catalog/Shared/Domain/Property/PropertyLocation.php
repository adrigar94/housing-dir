<?php

namespace App\Catalog\Shared\Domain\Property;

use Exception;
use JsonSerializable;

final class PropertyLocation implements JsonSerializable
{
    public function __construct(
        private string $country,
        private string $region,
        private string $city,
        private string $address
    ) {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->address = $address;
    }

    public function country($new): string
    {
        if ($new) {
            $this->country = $new;
        }
        return $this->country;
    }

    public function region($new): string
    {
        if ($new) {
            $this->region = $new;
        }
        return $this->region;
    }

    public function city($new): string
    {
        if ($new) {
            $this->city = $new;
        }
        return $this->city;
    }

    public function address($new): string
    {
        if ($new) {
            $this->address = $new;
        }
        return $this->address;
    }

    public function toArray(): array
    {
        return [
            'country' => $this->country,
            'region' => $this->region,
            'city' => $this->city,
            'address' => $this->address,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public static function fromArray(array $value): self
    {
        $country = $value['country'] ?? throw new Exception("Missing parameter country in location", 500);
        $region = $value['region'] ?? throw new Exception("Missing parameter region in location", 500);
        $city = $value['city'] ?? throw new Exception("Missing parameter city in location", 500);
        $address = $value['address'] ?? throw new Exception("Missing parameter address in location", 500);
        return new self($country, $region, $city, $address);
    }
}
