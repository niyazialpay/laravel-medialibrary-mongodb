<?php

namespace niyazialpay\MediaLibrary\Conversions\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use niyazialpay\MediaLibrary\Conversions\ConversionCollection;
use niyazialpay\MediaLibrary\Conversions\FileManipulator;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class PerformConversionsJob implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $deleteWhenMissingModels = true;

    public function __construct(
        protected ConversionCollection $conversions,
        protected Media $media,
        protected bool $onlyMissing = false,
    ) {
    }

    public function handle(FileManipulator $fileManipulator): bool
    {
        $fileManipulator->performConversions(
            $this->conversions,
            $this->media,
            $this->onlyMissing
        );

        return true;
    }
}
