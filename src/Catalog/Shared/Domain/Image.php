<?php

namespace App\Catalog\Shared\Domain;

use Exception;
use JsonSerializable;

final class Image implements JsonSerializable
{
    public const THUMBNAIL_DIM = ["max_width" => 150, "max_height" => 150];
    public const TINY_DIM = ["max_width" => 480, "max_height" => 270];
    public const MEDIUM_DIM = ["max_width" => 1280, "max_height" => 720];
    public const LARGE_DIM = ["max_width" => 1920, "max_height" => 1080];

    public function __construct(
        private string $url_thumbnail,
        private string $url_tiny,
        private string $url_medium,
        private string $url_large,
        private ?string $title = null,
        private ?string $alt = null,
    ) {
        $this->url_thumbnail = $url_thumbnail;
        $this->url_tiny = $url_tiny;
        $this->url_medium = $url_medium;
        $this->url_large = $url_large;
        $this->title = $title;
        $this->alt = $alt;
    }

    public static function fromArray(array $value): self
    {
        $url_thumbnail = $value['url_thumbnail'] ?? throw new Exception("Missing parameter url_thumbnail in image", 500);
        $url_tiny = $value['url_tiny'] ?? throw new Exception("Missing parameter url_tiny in image", 500);
        $url_medium = $value['url_medium'] ?? throw new Exception("Missing parameter url_medium in image", 500);
        $url_large = $value['url_large'] ?? throw new Exception("Missing parameter url_large in image", 500);
        $title = $value['title'] ?? null;
        $alt = $value['alt'] ?? null;
        return new static($url_thumbnail, $url_tiny, $url_medium, $url_large, $title, $alt);
    }

    public function toArray(): array
    {
        return [
            'url_thumbnail' => $this->url_thumbnail,
            'url_tiny' => $this->url_tiny,
            'url_medium' => $this->url_medium,
            'url_large' => $this->url_large,
            'title' => $this->title,
            'alt' => $this->alt,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function url(ImageSizes $size): string
    {
        switch ($size) {
            case ImageSizes::THUMBNAIL:
                return $this->url_thumbnail;

            case ImageSizes::TINY:
                return $this->url_tiny;

            case ImageSizes::MEDIUM:
                return $this->url_medium;

            case ImageSizes::LARGE:
                return $this->url_large;

            default:
                return $this->url_thumbnail;
        }
    }
}
