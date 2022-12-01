<?php

namespace App\Tests\Catalog\Shared\Domain\Property;

use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Tests\Catalog\Shared\Domain\ImageMother;

class PropertyGalleryMother
{
    public static function create(): PropertyGallery
    {
        $images = [];
        for ($i = 0; $i < random_int(1, 10); $i++) {
            $images[] = ImageMother::create();
        }
        return new PropertyGallery(...$images);
    }
}
