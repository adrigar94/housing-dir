<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\Property;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Shared\Domain\ValueObject\BoolValueObject;
use DateTime;

final class RentalProperty extends Property
{
    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyCommonCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery,
        private PropertyPrice $price_month,
        private BoolValueObject $pets_allowed,
        DateTime $updated_at = new DateTime(),
        DateTime $created_at = new DateTime()
    ) {
        parent::__construct($id, $title, $description, $characteristics, $location, $gallery, $created_at, $updated_at);
        $this->price_month = $price_month;
        $this->pets_allowed = $pets_allowed;
    }


    public function priceMonth(PropertyPrice $new = null): PropertyPrice
    {
        if (!is_null($new)) {
            $this->price_month = $new;
        }
        return $this->price_month;
    }

    public function petsAllowed(PropertyPrice $new = null): BoolValueObject
    {
        if (!is_null($new)) {
            $this->pets_allowed = $new;
        }
        return $this->pets_allowed;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'description' => $this->description(),
            'characteristics' => $this->characteristics(),
            'location' => $this->location(),
            'gallery' => $this->gallery(),
            'price_month' => $this->priceMonth(),
            'pets_allowed' => $this->petsAllowed(),
            'updated_at' => $this->updatedAt(),
            'created_at' => $this->createdAt(),
        ];
    }
}
