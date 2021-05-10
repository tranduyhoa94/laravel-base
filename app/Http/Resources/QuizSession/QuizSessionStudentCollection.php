<?php

namespace App\Http\Resources\QuizSession;

use App\Http\Resources\PaginatedCollection;

class QuizSessionStudentCollection extends PaginatedCollection
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
