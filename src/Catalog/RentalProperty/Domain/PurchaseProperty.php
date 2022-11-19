<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\Property;
use App\Catalog\Shared\Domain\Property\PropertyPrice;

class PurchaseProperty extends Property
{
    private $price;
    private $community_price;

    public function price(PropertyPrice $new = null): PropertyPrice
    {
        if(!is_null($new)){
            $this->price = $new;
        }
        return $this->price;
    }

    public function communityPrice(PropertyPrice $new = null): PropertyPrice
    {
        if(!is_null($new)){
            $this->community_price = $new;
        }
        return $this->community_price;
    }
}
