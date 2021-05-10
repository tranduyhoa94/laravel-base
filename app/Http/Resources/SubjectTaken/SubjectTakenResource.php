<?php

namespace App\Http\Resources\SubjectTaken;

use App\Http\Resources\Subject\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectTakenResource extends JsonResource
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
            'subject_id',
            'student_id'
        ]);

        $result['subjects'] = new SubjectResource($this->whenLoaded('subject'));
        return $result;
    }
}
