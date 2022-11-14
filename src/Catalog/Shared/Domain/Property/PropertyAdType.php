<?php

namespace App\Catalog\Shared\Domain\Property;

final class PropertyAdType
{

    private $ad_type;

    public function __construct(PropertyAdTypeEnum $ad_type)
    {
        $this->ad_type = $ad_type;
    }

    public static function rental(): self
    {
        return new self(PropertyAdTypeEnum::Rental);
    }

    public static function purchase(): self
    {
        return new self(PropertyAdTypeEnum::Purchase);
    }

    public function type(): PropertyAdTypeEnum
    {
        return $this->ad_type;
    } 
}
