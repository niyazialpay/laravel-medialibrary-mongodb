<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport\TestModels;

use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class TestModelWithResponsiveImages extends TestModel
{
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->withResponsiveImages()
            ->width(50)
            ->nonQueued();

        $this
            ->addMediaConversion('otherImageConversion')
            ->greyscale();

        $this
            ->addMediaConversion('pngtojpg')
            ->width(700)
            ->quality(1)
            ->background('#ff00ff')
            ->format('jpg')
            ->withResponsiveImages();

        $this
            ->addMediaConversion('lowerQuality')
            ->withResponsiveImages()
            ->quality(60)
            ->nonQueued();

        $this
            ->addMediaConversion('standardQuality')
            ->withResponsiveImages()
            ->nonQueued();
    }
}
