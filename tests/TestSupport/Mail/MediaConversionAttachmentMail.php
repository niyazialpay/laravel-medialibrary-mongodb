<?php

namespace niyazialpay\MediaLibrary\Tests\TestSupport\Mail;

use Illuminate\Mail\Mailable;
use niyazialpay\MediaLibrary\MediaCollections\Models\Media;

class MediaConversionAttachmentMail extends Mailable
{
    public function __construct(public Media $media)
    {
    }

    public function build()
    {
        $thumbnailAttachment = $this->media->mailAttachment('thumb');

        return $this
            ->to('johndoe@example.com')
            ->view('mailable')
            ->attach($thumbnailAttachment);
    }
}
