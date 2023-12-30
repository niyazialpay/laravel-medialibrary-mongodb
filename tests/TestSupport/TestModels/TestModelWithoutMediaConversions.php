<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport\TestModels;

use MongoDB\Laravel\Eloquent\Model;
use niyazialpay\MediaLibrary\HasMedia;
use niyazialpay\MediaLibrary\InteractsWithMedia;

class TestModelWithoutMediaConversions extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'test_models';

    protected $guarded = [];

    public $timestamps = false;
}
