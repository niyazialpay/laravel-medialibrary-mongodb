<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport\TestModels;

use MongoDB\Laravel\Eloquent\Model;
use niyazialpay\MediaLibrary\HasMedia;
use niyazialpay\MediaLibrary\InteractsWithMedia;

class TestModel extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'test_models';

    protected $guarded = [];

    public $timestamps = false;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->useFallbackUrl('/default-url.jpg')
            ->useFallbackUrl('/default-avatar-thumb-url.jpg', 'avatar_thumb')
            ->useFallbackPath('/default-path.jpg')
            ->useFallbackPath('/default-avatar-thumb-path.jpg', 'avatar_thumb');
    }
}
