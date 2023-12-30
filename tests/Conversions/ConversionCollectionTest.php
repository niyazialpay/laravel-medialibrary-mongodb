<?php

use niyazialpay\MediaLibrary\Conversions\ConversionCollection;

beforeEach(function () {
    $media = $this->testModelWithConversion
        ->addMedia($this->getTestJpg())
        ->preservingOriginal()
        ->toMediaCollection();

    $media->manipulations = ['thumb' => ['greyscale' => [], 'height' => [10]]];
    $media->save();

    $secondMedia = $this->testModelWithConversion
        ->addMedia($this->getTestJpg())
        ->preservingOriginal()
        ->toMediaCollection();

    $secondMedia->manipulations = ['thumb' => ['greyscale' => [], 'height' => [20]]];
    $secondMedia->save();

    $this->media = $media->fresh();
    $this->secondMedia = $media->fresh();
});

it('will prepend the manipulation saved on the model and the wildmark manipulations', function () {
    $this->media->manipulations = [
        '*' => ['brightness' => ['-80']],
        'thumb' => ['greyscale' => [], 'height' => [10]],
    ];

    $conversionCollection = ConversionCollection::createForMedia($this->media);

    $conversion = $conversionCollection->getConversions()[0];

    expect($conversion->getName())->toEqual('thumb');

    $manipulations = $conversion
        ->getManipulations()
        ->toArray();

    $this->assertArrayHasKey('optimize', $manipulations);

    unset($manipulations['optimize']);

    $this->assertEquals([
        'greyscale' => [],
        'height' => [10],
        'brightness' => ['-80'],
        'format' => ['jpg'],
        'width' => [50],
    ], $manipulations);
});

it('will prepend the manipulation saved on the model', function () {
    $conversionCollection = ConversionCollection::createForMedia($this->media);

    $conversion = $conversionCollection->getConversions()->first();

    expect($conversion->getName())->toEqual('thumb');

    $manipulations = $conversion
        ->getManipulations()
        ->toArray();

    $this->assertArrayHasKey('optimize', $manipulations);

    unset($manipulations['optimize']);

    $this->assertEquals([
        'greyscale' => [],
        'height' => [10],
        'format' => ['jpg'],
        'width' => [50],
    ], $manipulations);
});

it('will apply the manipulation on the equally named conversion of every model', function () {
    $mediaItems = [$this->media, $this->secondMedia];
    $manipulations = [];

    foreach ($mediaItems as $mediaItem) {
        $conversionCollection = ConversionCollection::createForMedia($mediaItem);

        $conversion = $conversionCollection->getConversions()[0];

        $manipulationSequence = $conversion
            ->getManipulations()
            ->getManipulationSequence()
            ->toArray();

        $manipulations[] = $manipulationSequence;
    }

    expect($manipulations[1])->toEqual($manipulations[0]);
});
