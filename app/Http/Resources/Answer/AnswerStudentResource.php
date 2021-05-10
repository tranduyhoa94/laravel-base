<?php

namespace App\Http\Resources\Answer;

use App\Http\Resources\BaseResource;

class AnswerStudentResource extends BaseResource
{
    protected function defaultFields()
    {
        $result = $this->resource->only([
            'id',
            'content',
            'question_id',
        ]);

        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function studentFields()
    {
        return $this->resource->only(['is_correct']);
    }
}
