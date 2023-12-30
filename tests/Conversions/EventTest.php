<?php

use Illuminate\Support\Facades\Event;
use niyazialpay\MediaLibrary\Conversions\Events\ConversionHasBeenCompletedEvent;
use niyazialpay\MediaLibrary\Conversions\Events\ConversionWillStartEvent;
use niyazialpay\MediaLibrary\MediaCollections\Events\CollectionHasBeenClearedEvent;

beforeEach(function () {
    Event::fake();
});

it('will fire the conversion will start event', function () {
    $this->testModelWithConversion->addMedia($this->getTestJpg())->toMediaCollection('images');

    Event::assertDispatched(ConversionWillStartEvent::class);
});

it('will fire the conversion complete event', function () {
    $this->testModelWithConversion->addMedia($this->getTestJpg())->toMediaCollection('images');

    Event::assertDispatched(ConversionHasBeenCompletedEvent::class);
});

it('will fire the collection cleared event', function () {
    $this->testModel
        ->addMedia($this->getTestJpg())
        ->preservingOriginal()
        ->toMediaCollection('images');

    $this->testModel->clearMediaCollection('images');

    Event::assertDispatched(CollectionHasBeenClearedEvent::class);
});
