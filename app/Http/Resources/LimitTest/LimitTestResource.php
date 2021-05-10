<?php

namespace App\Http\Resources\LimitTest;

use App\Http\Resources\Subject\SubjectResource;
use App\Http\Resources\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LimitTestResource extends JsonResource
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
            'times',
            'student_id',
            'subject_id',
            'start_time',
            'end_time'
        ]);

        $result['subjects'] = new SubjectResource($this->whenLoaded('subjects'));

        $result['students'] = new StudentResource($this->whenLoaded('students'));

        return $result;
    }
}
