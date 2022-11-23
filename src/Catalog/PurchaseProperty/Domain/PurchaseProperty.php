<?php

namespace App\Catalog\PurchaseProperty\Domain;

use App\Catalog\Shared\Domain\Property\Property;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use DateTime;

final class PurchaseProperty extends Property
{
    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyCommonCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery,
        private PropertyPrice $price,
        private PropertyPrice $community_price,
        DateTime $updated_at = new DateTime(),
        DateTime $created_at = new DateTime()
    ) {
        parent::__construct($id, $title, $description, $characteristics, $location, $gallery, $created_at, $updated_at);
        $this->price = $price;
        $this->community_price = $community_price;
    }

    public function price(PropertyPrice $new = null): PropertyPrice
    {
        if (!is_null($new)) {
            $this->price = $new;
        }
        return $this->price;
    }

    public function communityPrice(PropertyPrice $new = null): PropertyPrice
    {
        if (!is_null($new)) {
            $this->community_price = $new;
        }
        return $this->community_price;
    }
}
