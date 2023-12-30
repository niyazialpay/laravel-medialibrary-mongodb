<?php

namespace niyazialpay\MediaLibrary\Conversions\Actions;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use niyazialpay\Image\Exceptions\UnsupportedImageFormat;
use niyazialpay\Image\Image;
use niyazialpay\MediaLibrary\Conversions\Conversion;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class PerformManipulationsAction
{
    public function execute(
        Media $media,
        Conversion $conversion,
        string $imageFile,
    ): string {

        if ($conversion->getManipulations()->isEmpty()) {
            return $imageFile;
        }

        $conversionTempFile = $this->getConversionTempFileName($media, $conversion, $imageFile);

        File::copy($imageFile, $conversionTempFile);

        $supportedFormats = ['jpg', 'pjpg', 'png', 'gif'];
        if ($conversion->shouldKeepOriginalImageFormat() && in_array($media->extension, $supportedFormats)) {
            $conversion->format($media->extension);
        }

        $image = Image::useImageDriver(config('media-library.image_driver'))
            ->loadFile($conversionTempFile)
            ->format('jpg');

        try {
            $conversion->getManipulations()->apply($image);

            $image->save();
        } catch (UnsupportedImageFormat) {

        }

        return $conversionTempFile;
    }

    protected function getConversionTempFileName(
        Media $media,
        Conversion $conversion,
        string $imageFile,
    ): string {
        $directory = pathinfo($imageFile, PATHINFO_DIRNAME);

        $extension = $media->extension;

        if ($extension === '') {
            $extension = 'jpg';
        }

        $fileName = Str::random(32)."{$conversion->getName()}.{$extension}";

        return "{$directory}/{$fileName}";
    }
}
