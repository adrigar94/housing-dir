<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Create;

use App\Catalog\Shared\Domain\Property\PropertyCommonCharacteristics\PropertyCommonCharacteristics;
use App\Catalog\Shared\Domain\Property\PropertyDescription;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyLocation;
use App\Catalog\Shared\Domain\Property\PropertyPrice;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\ValueObject\BoolValueObject;

class CreateRentalPropertyCommandHandler implements CommandHandler
{
    public function __construct(private RentalPropertyCreator $rentalPropertyCreator)
    {
    }

    public function __invoke(CreateRentalPropertyCommand $command): void
    {
        $id              = new PropertyId($command->getUuid());
        $title           = new PropertyTitle($command->getTitle());
        $description     = new PropertyDescription($command->getDescription());
        $characteristics = PropertyCommonCharacteristics::fromArray($command->getCharacteristics());
        $location        = PropertyLocation::fromArray($command->getLocation());
        $gallery         = PropertyGallery::fromArray($command->getGallery());
        $price_month     = PropertyPrice::fromArray($command->getPriceMonth());
        $pets_allowed    = new BoolValueObject($command->getPetsAllowed());

        $this->rentalPropertyCreator->__invoke(
            $id,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery,
            $price_month,
            $pets_allowed
        );
    }
}
