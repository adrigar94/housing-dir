<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Create;

use App\Shared\Domain\Bus\Command\Command;

class CreateRentalPropertyCommand implements Command
{
    public function __construct(
        private string $uuid,
        private string $title,
        private string $description,
        private array $characteristics,
        private array $location,
        private array $gallery,
        private array $price_month,
        private bool $pets_allowed
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCharacteristics(): array
    {
        return $this->characteristics;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function getGallery(): array
    {
        return $this->gallery;
    }

    public function getPriceMonth(): array
    {
        return $this->price_month;
    }

    public function getPetsAllowed(): bool
    {
        return $this->pets_allowed;
    }
}
