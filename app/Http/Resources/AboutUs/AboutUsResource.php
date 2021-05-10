<?php

namespace App\Http\Resources\AboutUs;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($request)
    {
        return $this->resource->only([
            'title',
            'description',
            'facebook_path',
            'instagram_path',
            'youtube_path',
            'twitter_path',
            'email_us',
            'phone_us',
            'address_us'
        ]);
    }
}
