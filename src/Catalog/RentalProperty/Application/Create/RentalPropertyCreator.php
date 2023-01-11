<?php

namespace App\Catalog\RentalProperty\Application\Create;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Shared\Domain\ValueObject\Uuid;

final class RentalPropertyCreator
{
    public function __construct(
        private RentalPropertyRepository $repository,
        private EventBus $eventBus
    ) {
    }

    public function __invoke(
        PropertyId $id,
        PropertyTitle $title,
        PropertyDescription $description,
        PropertyCommonCharacteristics $characteristics,
        PropertyLocation $location,
        PropertyGallery $gallery,
        PropertyPrice $price_month,
        BoolValueObject $pets_allowed
    ): void {
        $rentalProperty = new RentalProperty(
            $id,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery,
            $price_month,
            $pets_allowed
        );

        $this->repository->save($rentalProperty);

        $events = $rentalProperty->pullDomainEvents();

        $this->eventBus->publish(...$events);
    }
}
