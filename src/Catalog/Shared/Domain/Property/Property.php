<?php

namespace App\Catalog\Shared\Domain\Property;

use DateTime;

abstract class Property
{
    protected $id;
    protected $title;
    protected $description;
    protected $characteristics;
    protected $location;
    protected $published_at;

    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery,
        PropertyPrice $price_month,
        DateTime $published_at = new DateTime()
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->characteristics = $characteristics;
        $this->location = $location;
        $this->gallery = $gallery;
        $this->price_month = $price_month;
        $this->published_at = $published_at;
    }

    public function id(): PropertyId
    {
        return $this->id;
    }
    public function title(): PropertyTitle
    {
        return $this->title;
    }
    public function description(): PropertyDescription
    {
        return $this->description;
    }
    public function characteristics(): PropertyCharacteristics
    {
        return $this->characteristics;
    }
    public function location(): PropertyLocation
    {
        return $this->location;
    }
    public function gallery(): PropertyGallery
    {
        return $this->gallery;
    }
    public function priceMonth(): PropertyPrice
    {
        return $this->price_month;
    }
    public function publishedAt(): DateTime
    {
        return $this->published_at;
    }
}
