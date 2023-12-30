<?php

namespace niyazialpay\MediaLibrary\MediaCollections\Exceptions;

use Exception;
use niyazialpay\MediaLibrary\Support\FileRemover\FileRemover;

class InvalidFileRemover extends Exception
{
    public static function doesntExist(string $class): self
    {
        return new static("File remover class `{$class}` doesn't exist");
    }

    public static function doesNotImplementFileRemover(string $class): self
    {
        $fileRemoverClass = FileRemover::class;

        return new static("File remover class `{$class}` must implement `$fileRemoverClass}`");
    }
}
