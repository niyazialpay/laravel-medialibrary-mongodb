<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport;

use Illuminate\Support\Collection;
use niyazialpay\MediaLibrary\Conversions\Conversion;
use niyazialpay\MediaLibrary\Conversions\ImageGenerators\ImageGenerator;

class TestImageGeneratorWithConfig extends ImageGenerator
{
    public function __construct(
        public string $firstName,
        public string $secondName
    ) {
    }

    public function convert(string $file, ?Conversion $conversion = null): string
    {
        // TODO: Implement convert() method.
    }

    public function requirementsAreInstalled(): bool
    {
        // TODO: Implement requirementsAreInstalled() method.
    }

    public function supportedExtensions(): Collection
    {
        // TODO: Implement supportedExtensions() method.
    }

    public function supportedMimeTypes(): Collection
    {
        // TODO: Implement supportedMimeTypes() method.
    }
}
