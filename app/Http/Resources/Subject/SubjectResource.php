<?php

namespace App\Http\Resources\Subject;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
        $result = $this->resource->only([
            'id',
            'name',
            'created_by',
            'is_active',
            'created_at',
            'code',
            'color'
        ]);

        if ($this->resource->relationLoaded('topics')) {
            $result['topics_count'] = $this->whenLoaded('topics')->count();
        }

        return $result;
    }
}
