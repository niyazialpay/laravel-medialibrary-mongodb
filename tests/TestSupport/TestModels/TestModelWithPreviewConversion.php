<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport\TestModels;

use niyazialpay\Image\Enums\Fit;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class TestModelWithPreviewConversion extends TestModel
{
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
