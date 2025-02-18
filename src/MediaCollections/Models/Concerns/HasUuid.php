<?php

namespace niyazialpay\MediaLibrary\MediaCollections\Models\Concerns;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            /** @var \niyazialpay\MediaLibrary\MediaCollections\Models\Media $model */
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public static function findByUuid(string $uuid): ?Model
    {
        return static::where('uuid', $uuid)->first();
    }
}
