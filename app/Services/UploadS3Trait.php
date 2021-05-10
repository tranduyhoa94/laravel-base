<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

trait UploadS3Trait
{
    public function uploadImageS3($folder, $file)
    {
        return Storage::disk('s3')->put($folder, $file);
    }

    public function checkUrlPath($url)
    {
        if (Storage::disk('s3')->exists($url)) {
            return true;
        }

        return null;
    }

    public function getUrl()
    {
        return 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    }

    public function deleleImageS3($url)
    {
        Storage::disk('s3')->delete($url);
    }
}
