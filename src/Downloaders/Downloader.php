<?php

namespace niyazialpay\MediaLibrary\Downloaders;

interface Downloader
{
    public function getTempFile(string $url): string;
}
