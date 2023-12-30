<?php

namespace niyazialpay\MediaLibrary\MediaCollections\Events;

use Illuminate\Queue\SerializesModels;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class MediaHasBeenAddedEvent
{
    use SerializesModels;

    public function __construct(public Media $media)
    {
    }
}
