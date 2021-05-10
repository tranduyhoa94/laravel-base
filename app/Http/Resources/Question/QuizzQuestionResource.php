<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerCollection;
use App\Http\Resources\BaseResource;

class QuizzQuestionResource extends BaseResource
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

        $result['answers'] = new AnswerCollection($this->whenLoaded('answers'));

        $result['answer_shuffle'] = new AnswerCollection($this->whenLoaded('answerShuffle'));

        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function adminFields()
    {
        return $this->resource->only(['note', 'is_approved']);
    }

    /**
     * @inheritDoc
     */
    protected function teacherFields()
    {
        return $this->resource->only(['note', 'is_approved']);
    }
}
