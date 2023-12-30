<?php

namespace niyazialpay\MediaLibrary\MediaCollections\Events;

use Illuminate\Queue\SerializesModels;
use niyazialpay\MediaLibrary\HasMedia;

class CollectionHasBeenClearedEvent
{
    use SerializesModels;

    public function __construct(public HasMedia $model, public string $collectionName)
    {
    }
}
