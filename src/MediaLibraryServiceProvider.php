<?php

namespace niyazialpay\MediaLibrary;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use niyazialpay\MediaLibrary\Conversions\Commands\RegenerateCommand;
use niyazialpay\MediaLibrary\MediaCollections\Commands\CleanCommand;
use niyazialpay\MediaLibrary\MediaCollections\Commands\ClearCommand;
use niyazialpay\MediaLibrary\MediaCollections\MediaRepository;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;
use niyazialpay\MediaLibrary\MediaCollections\Models\Observers\MediaObserver;
use niyazialpay\MediaLibrary\ResponsiveImages\TinyPlaceholderGenerator\TinyPlaceholderGenerator;
use niyazialpay\MediaLibrary\ResponsiveImages\WidthCalculator\WidthCalculator;

class MediaLibraryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-medialibrary')
            ->hasConfigFile('media-library')
            ->hasMigration('create_media_table')
            ->hasViews('media-library')
            ->hasCommands([
                RegenerateCommand::class,
                ClearCommand::class,
                CleanCommand::class,
            ]);
    }

    public function packageBooted()
    {
        $mediaClass = config('media-library.media_model', Media::class);

        $mediaClass::observe(new MediaObserver());
    }

    public function packageRegistered()
    {
        $this->app->bind(WidthCalculator::class, config('media-library.responsive_images.width_calculator'));
        $this->app->bind(TinyPlaceholderGenerator::class, config('media-library.responsive_images.tiny_placeholder_generator'));

        $this->app->scoped(MediaRepository::class, function () {
            $mediaClass = config('media-library.media_model');

            return new MediaRepository(new $mediaClass());
        });
    }
}
