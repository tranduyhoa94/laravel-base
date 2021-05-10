<?php

namespace App\Http\Resources\Answer;

use App\Http\Resources\PaginatedCollection;

class AnswerCollection extends PaginatedCollection
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
