<?php

namespace App\Http\Resources\Answer;

use App\Http\Resources\BaseResource;

class AnswerResource extends BaseResource
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
    protected function adminFields()
    {
        return $this->resource->only(['is_correct']);
    }

    /**
     * @inheritDoc
     */
    protected function teacherFields()
    {
        return $this->resource->only(['is_correct']);
    }
}
