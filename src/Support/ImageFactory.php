<?php

namespace niyazialpay\MediaLibrary\Support;

use niyazialpay\Image\Drivers\ImageDriver;
use niyazialpay\Image\Image;

class ImageFactory
{
    public static function load(string $path): ImageDriver
    {
        return Image::useImageDriver(config('media-library.image_driver'))
            ->loadFile($path);
    }
}
