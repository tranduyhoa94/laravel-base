<?php

namespace App\Http\Resources\Topic;

use App\Http\Resources\Subject\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
        $result =  $this->resource->only([
            'id',
            'name',
            'subject_id',
            'is_active',
            'description'
        ]);

        $result['subject'] = new SubjectResource($this->whenLoaded('subject'));

        return $result;
    }
}
