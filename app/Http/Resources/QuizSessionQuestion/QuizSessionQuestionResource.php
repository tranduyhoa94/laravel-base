<?php

namespace App\Http\Resources\QuizSessionQuestion;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Question\QuizzQuestionResource;

class QuizSessionQuestionResource extends BaseResource
{
    protected function defaultFields()
    {
        $result = $this->resource->only([
            'id',
            'quiz_session_id',
        ]);

        $result['question'] = new QuizzQuestionResource($this->whenLoaded('question'));

        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function adminFields()
    {
        return $this->resource->only(['choose_answers', 'content_answers', 'is_correct', 'note']);
    }

    /**
     * @inheritDoc
     */
    protected function teacherFields()
    {
        return $this->resource->only(['choose_answers', 'content_answers', 'is_correct', 'note']);
    }
}
