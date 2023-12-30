<?php

namespace niyazialpay\MediaLibrary\Conversions\Events;

use Illuminate\Queue\SerializesModels;
use niyazialpay\MediaLibrary\Conversions\Conversion;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class ConversionWillStartEvent
{
    use SerializesModels;

    public function __construct(
        public Media $media,
        public Conversion $conversion,
        public string $copiedOriginalFile,
    ) {
    }
}
