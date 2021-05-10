<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerStudentCollection;
use App\Http\Resources\BaseResource;

class QuestionStudentResource extends BaseResource
{
    protected function defaultFields()
    {
        $result = $this->resource->only([
            'id',
            'name',
            'type',
            'quizz_id',
            'is_approved',
            'note',
            'image_url'
        ]);

        $result['answers'] = new AnswerStudentCollection($this->whenLoaded('answers'));

        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function studentFields()
    {
        return $this->resource->only(['note', 'is_approved']);
    }
}
