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
    protected $gallery;
    protected $published_at;
    protected $updated_at;

    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyCommonCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery,
        DateTime $published_at = new DateTime(),
        DateTime $updated_at = new DateTime(),
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->characteristics = $characteristics;
        $this->location = $location;
        $this->gallery = $gallery;
        $this->published_at = $published_at;
        $this->updated_at = $updated_at;
    }

    public function id(): PropertyId
    {
        return $this->id;
    }
    public function title(PropertyTitle $new = null): PropertyTitle
    {
        if($new){
            $this->title = $new;
        }
        return $this->title;
    }
    public function description(PropertyDescription $new = null): PropertyDescription
    {
        if($new){
            $this->description = $new;
        }
        return $this->description;
    }
    public function characteristics(PropertyCommonCharacteristics $new = null): PropertyCommonCharacteristics
    {
        if($new){
            $this->characteristics = $new;
        }
        return $this->characteristics;
    }
    public function location(PropertyLocation $new = null): PropertyLocation
    {
        if($new){
            $this->location = $new;
        }
        return $this->location;
    }
    public function gallery(PropertyGallery $new = null): PropertyGallery
    {
        if($new){
            $this->gallery = $new;
        }
        return $this->gallery;
    }
    public function publishedAt(): DateTime
    {
        return $this->published_at;
    }
    public function updatedAt(): DateTime
    {
        return $this->updated_at;
    }
}
