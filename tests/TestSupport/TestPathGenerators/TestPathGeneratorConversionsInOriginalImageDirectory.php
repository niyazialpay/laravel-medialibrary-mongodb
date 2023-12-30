<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport\TestPathGenerators;

use niyazialpay\MediaLibrary\MediaCollections\Models\Media;
use niyazialpay\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;
use niyazialpay\MediaLibrary\Support\PathGenerator\PathGenerator;

class TestPathGeneratorConversionsInOriginalImageDirectory extends DefaultPathGenerator implements PathGenerator
{
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media);
    }
}
