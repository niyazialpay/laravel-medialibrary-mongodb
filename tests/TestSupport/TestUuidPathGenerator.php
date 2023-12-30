<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport;

use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class TestUuidPathGenerator extends TestPathGenerator
{
    public function getPath(Media $media): string
    {
        return "{$media->uuid}/";
    }
}
