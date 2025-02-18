<?php

namespace niyazialpay\MediaLibrary\Support\FileNamer;

use Illuminate\Support\Str;
use niyazialpay\MediaLibrary\Conversions\Conversion;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

abstract class FileNamer
{
    public function originalFileName(string $fileName): string
    {
        $extLength = strlen(pathinfo($fileName, PATHINFO_EXTENSION));

        $baseName = substr($fileName, 0, strlen($fileName) - ($extLength ? $extLength + 1 : 0));

        return Str::slug($baseName);
    }

    abstract public function conversionFileName(string $fileName, Conversion $conversion): string;

    abstract public function responsiveFileName(string $fileName): string;

    public function temporaryFileName(Media $media, string $extension): string
    {
        return "{$this->responsiveFileName($media->file_name)}.{$extension}";
    }

    public function extensionFromBaseImage(string $baseImage): string
    {
        return pathinfo($baseImage, PATHINFO_EXTENSION);
    }
}
