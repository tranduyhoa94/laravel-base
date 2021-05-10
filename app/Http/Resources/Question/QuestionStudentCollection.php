<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\PaginatedCollection;

class QuestionStudentCollection extends PaginatedCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($request)
    {
        return $this->getResourceClass()::collection($this->resource);
    }
}
