<?php

namespace App\Catalog\Shared\Domain;

enum ImageSizes: string
{
    case THUMBNAIL = "thumbnail";
    case TINY = "tiny";
    case MEDIUM = "medium";
    case LARGE = "large";
}
