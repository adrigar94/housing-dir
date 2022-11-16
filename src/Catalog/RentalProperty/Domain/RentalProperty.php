<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\PropertyCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use DateTime;

final class RentalProperty
{
    private $id;
    private $title;
    private $description;
    private $characteristics;
    private $location;
    private $published_at;

    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery,
        DateTime $published_at = new DateTime()
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->characteristics = $characteristics;
        $this->location = $location;
        $this->gallery = $gallery;
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
    public function published_at(): DateTime
    {
        return $this->gallery;
    }
}
