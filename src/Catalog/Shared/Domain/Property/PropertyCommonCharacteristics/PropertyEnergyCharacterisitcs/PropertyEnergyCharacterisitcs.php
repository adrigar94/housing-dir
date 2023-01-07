<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs;

class PropertyEnergyCharacterisitcs
{
    // TODO: generate label of energy certificate

    public function __construct(
        private ?Consumption $consumption = null,
        private ?Emissions $emissions = null
    ) {
        $this->consumption = $consumption;
        $this->emissions = $emissions;
    }

    public function consumption(): ?Consumption
    {
        return $this->consumption;
    }

    public function emissions(): ?Emissions
    {
        return $this->emissions;
    }

    public function toArray(): array
    {
        return [
            'consumption' => $this->consumption() ? $this->consumption()->toArray() : null,
            'emissions' => $this->emissions() ? $this->emissions()->toArray() : null
        ];
    }

    public static function fromArray(array $value): self
    {
        $consumtion = (isset($value['consumption']) and !is_null($value['consumption'])) ? Consumption::fromArray($value['consumption']) : null;
        $emissions = (isset($value['emissions']) and !is_null($value['emissions'])) ? Emissions::fromArray($value['emissions']) : null;

        return new self($consumtion, $emissions);
    }
}
