<?php

namespace App\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Image;
use JsonSerializable;

final class PropertyGallery implements JsonSerializable
{
    private $images = [];

    public function __construct(Image ...$images)
    {
        $this->images = $images;
    }

    public function values()
    {
        return $this->images;
    }

    public static function fromArray(array $values): self
    {
        $images = [];
        foreach ($values as $value) {
            $images[] = Image::fromArray($value);
        }
        return new self(...$images);
    }

    public function toArray(): array
    {
        return $this->images;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
