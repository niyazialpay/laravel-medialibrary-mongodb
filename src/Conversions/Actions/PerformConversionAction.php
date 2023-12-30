<?php

namespace niyazialpay\MediaLibrary\Conversions\Actions;

use niyazialpay\MediaLibrary\Conversions\Conversion;
use niyazialpay\MediaLibrary\Conversions\Events\ConversionHasBeenCompletedEvent;
use niyazialpay\MediaLibrary\Conversions\Events\ConversionWillStartEvent;
use niyazialpay\MediaLibrary\Conversions\ImageGenerators\ImageGeneratorFactory;
use niyazialpay\MediaLibrary\MediaCollections\Filesystem;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;
use niyazialpay\MediaLibrary\ResponsiveImages\ResponsiveImageGenerator;

class PerformConversionAction
{
    public function execute(
        Conversion $conversion,
        Media $media,
        string $copiedOriginalFile
    ) {
        $imageGenerator = ImageGeneratorFactory::forMedia($media);

        $copiedOriginalFile = $imageGenerator->convert($copiedOriginalFile, $conversion);

        if (! $copiedOriginalFile) {
            return;
        }

        event(new ConversionWillStartEvent($media, $conversion, $copiedOriginalFile));

        $manipulationResult = (new PerformManipulationsAction())->execute($media, $conversion, $copiedOriginalFile);

        $newFileName = $conversion->getConversionFile($media);

        $renamedFile = $this->renameInLocalDirectory($manipulationResult, $newFileName);

        if ($conversion->shouldGenerateResponsiveImages()) {
            /** @var ResponsiveImageGenerator $responsiveImageGenerator */
            $responsiveImageGenerator = app(ResponsiveImageGenerator::class);

            $responsiveImageGenerator->generateResponsiveImagesForConversion(
                $media,
                $conversion,
                $renamedFile
            );
        }

        app(Filesystem::class)->copyToMediaLibrary($renamedFile, $media, 'conversions');

        $media->markAsConversionGenerated($conversion->getName());

        event(new ConversionHasBeenCompletedEvent($media, $conversion));
    }

    protected function renameInLocalDirectory(
        string $fileNameWithDirectory,
        string $newFileNameWithoutDirectory
    ): string {
        $targetFile = pathinfo($fileNameWithDirectory, PATHINFO_DIRNAME).'/'.$newFileNameWithoutDirectory;

        rename($fileNameWithDirectory, $targetFile);

        return $targetFile;
    }
}
