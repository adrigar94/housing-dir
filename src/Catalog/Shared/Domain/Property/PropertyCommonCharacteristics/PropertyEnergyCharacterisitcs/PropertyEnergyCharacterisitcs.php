<?php

namespace App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyEnergyCharacterisitcs;

class PropertyEnergyCharacterisitcs
{
    // TODO: generate label of energy certificate

    public function __construct(
        private Consumption $consumption,
        private Emissions $emissions
    ) {
        $this->consumption = $consumption;
        $this->emissions = $emissions;
    }

    public function consumption(): Consumption
    {
        return $this->consumption;
    }

    public function emissions(): Emissions
    {
        return $this->emissions;
    }

    public function toArray(): array
    {
        return [
            'consumption' => $this->consumption()->toArray(),
            'emissions' => $this->emissions()->toArray()
        ];
    }

    public static function fromArray(array $value): self
    {
        $consumtion = Consumption::fromArray($value['consumption']);
        $emissions = Emissions::fromArray($value['emissions']);

        return new static($consumtion,$emissions);
    }
}
