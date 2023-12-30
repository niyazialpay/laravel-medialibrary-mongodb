<?php

namespace niyazialpay\MediaLibrary\Downloaders;

use niyazialpay\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class DefaultDownloader implements Downloader
{
    public function getTempFile(string $url): string
    {
        $context = stream_context_create([
            'http' => [
                'header' => 'User-Agent: niyazialpay MediaLibrary',
            ],
        ]);

        if (! $stream = @fopen($url, 'r', false, $context)) {
            throw UnreachableUrl::create($url);
        }

        $temporaryFile = tempnam(sys_get_temp_dir(), 'media-library');

        file_put_contents($temporaryFile, $stream);

        fclose($stream);

        return $temporaryFile;
    }
}
