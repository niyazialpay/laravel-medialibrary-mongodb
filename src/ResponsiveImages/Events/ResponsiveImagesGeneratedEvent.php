<?php

namespace niyazialpay\MediaLibrary\ResponsiveImages\Events;

use Illuminate\Queue\SerializesModels;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class ResponsiveImagesGeneratedEvent
{
    use SerializesModels;

    public function __construct(public Media $media)
    {
    }
}
