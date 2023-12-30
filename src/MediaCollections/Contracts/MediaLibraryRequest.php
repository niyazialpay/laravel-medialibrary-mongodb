<?php

namespace niyazialpay\MediaLibrary\MediaCollections\Contracts;

use Illuminate\Support\Collection;

interface MediaLibraryRequest
{
    public function mediaLibraryRequestItems(string $key): Collection;
}
