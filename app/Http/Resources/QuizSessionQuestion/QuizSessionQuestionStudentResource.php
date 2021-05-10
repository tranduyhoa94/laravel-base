<?php

namespace App\Http\Resources\QuizSessionQuestion;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Question\QuestionStudentResource;

class QuizSessionQuestionStudentResource extends BaseResource
{
    protected function defaultFields()
    {
        $result = $this->resource->only([
            'id',
            'quiz_session_id',
        ]);

        $result['question'] = new QuestionStudentResource($this->whenLoaded('question'));

        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function studentFields()
    {
        return $this->resource->only(['choose_answers', 'content_answers', 'is_correct', 'note']);
    }
}
