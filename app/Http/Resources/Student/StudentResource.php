<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\SubjectTaken\SubjectTakenCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'email',
            'phone',
            'gender',
            'is_active',
            'address',
            'limit_count'

        ]);
        
        $result['subjects_taken'] = new SubjectTakenCollection($this->whenLoaded('subjectsTaken'));
        return $result;
    }
}
