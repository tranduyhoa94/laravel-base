<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'type',
            'quizz_id',
            'is_approved',
            'note'
        ]);

        if ($this->resource->relationLoaded('imageUrl')) {
            $result['imageUrl'] = $this->whenLoaded('imageUrl')->path;
        }

        return $result;
    }
}
