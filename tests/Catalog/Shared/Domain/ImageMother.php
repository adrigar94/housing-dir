<?php

namespace App\Tests\Catalog\Shared\Domain;

use App\Catalog\Shared\Domain\Image;
use Faker\Factory;

class ImageMother
{
    public static function create(): Image
    {
        $url_thumbnail = Factory::create()->url();
        $url_tiny = Factory::create()->url();
        $url_medium = Factory::create()->url();
        $url_large = Factory::create()->url();
        $title = Factory::create()->text(50);
        $alt = $title;
        return new Image($url_thumbnail, $url_tiny, $url_medium, $url_large, $title, $alt);
    }
}
