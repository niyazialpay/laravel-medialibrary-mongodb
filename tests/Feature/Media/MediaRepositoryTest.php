<?php

use niyazialpay\MediaLibrary\MediaCollections\MediaRepository;
use niyazialpay\MediaLibrary\Tests\TestSupport\TestModels\TestCustomMediaModel;

it('can use a custom media model', function () {
    config()->set('media-library.media_model', TestCustomMediaModel::class);

    $this->testModel
        ->addMedia($this->getTestJpg())
        ->toMediaCollection();

    $mediaRepository = app(MediaRepository::class);

    expect($mediaRepository->all()->getQueueableClass())->toEqual(TestCustomMediaModel::class);
});
