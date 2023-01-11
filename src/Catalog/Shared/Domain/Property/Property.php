<?php

namespace App\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Shared\Domain\Bus\Event\DomainEvent;
use DateTime;
use JsonSerializable;

abstract class Property implements JsonSerializable
{

    private array $domainEvents = [];
    public function __construct(
        protected PropertyId $id,
        protected PropertyTitle $title,
        protected PropertyDescription $description,
        protected PropertyCommonCharacteristics $characteristics,
        protected PropertyLocation $location,
        protected PropertyGallery $gallery,
        protected DateTime $updated_at = new DateTime(),
        protected DateTime $created_at = new DateTime(),
    ) {
    }

    public function id(): PropertyId
    {
        return $this->id;
    }
    public function title(PropertyTitle $new = null): PropertyTitle
    {
        if (!is_null($new)) {
            $this->title = $new;
        }
        return $this->title;
    }
    public function description(PropertyDescription $new = null): PropertyDescription
    {
        if (!is_null($new)) {
            $this->description = $new;
        }
        return $this->description;
    }
    public function characteristics(PropertyCommonCharacteristics $new = null): PropertyCommonCharacteristics
    {
        if (!is_null($new)) {
            $this->characteristics = $new;
        }
        return $this->characteristics;
    }
    public function location(PropertyLocation $new = null): PropertyLocation
    {
        if (!is_null($new)) {
            $this->location = $new;
        }
        return $this->location;
    }
    public function gallery(PropertyGallery $new = null): PropertyGallery
    {
        if (!is_null($new)) {
            $this->gallery = $new;
        }
        return $this->gallery;
    }
    public function createdAt(): DateTime
    {
        return $this->created_at;
    }
    public function updatedAt(): DateTime
    {
        return $this->updated_at;
    }

    abstract public function toArray(): array;

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }


    final public function pullDomainEvents(): array
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
