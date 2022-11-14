<?php

namespace App\Catalog\RentalProperty\Domain;

use App\Catalog\Shared\Domain\Property\PropertyAdType;
use App\Catalog\Shared\Domain\Property\PropertyCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyTitle;

final class RentalProperty
{
    private $id;
    private $title;
    private $description;
    private $type;
    private $characteristics;
    private $location;

    public function __construct(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyAdType $type,
        PropertyCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->characteristics = $characteristics;
        $this->type = $type;
        $this->location = $location;
        $this->gallery = $gallery;
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
    public function type(): PropertyAdType
    {
        return $this->type;
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
}
