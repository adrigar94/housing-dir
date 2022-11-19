<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\Property;
use App\Catalog\Shared\Domain\Property\PropertyPrice;

final class RentalProperty extends Property
{
    private $price_month;

    
    public function priceMonth(PropertyPrice $new = null): PropertyPrice
    {
        if(!is_null($new)){
            $this->price_month = $new;
        }
        return $this->price_month;
    }
}
