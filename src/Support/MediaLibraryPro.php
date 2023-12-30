<?php

namespace niyazialpay\MediaLibrary\Support;

use niyazialpay\MediaLibrary\MediaCollections\Exceptions\FunctionalityNotAvailable;
use niyazialpay\MediaLibraryPro\Models\TemporaryUpload;

class MediaLibraryPro
{
    public static function ensureInstalled(): void
    {
        if (! self::isInstalled()) {
            throw FunctionalityNotAvailable::mediaLibraryProRequired();
        }
    }

    public static function isInstalled(): bool
    {
        return class_exists(TemporaryUpload::class);
    }
}
