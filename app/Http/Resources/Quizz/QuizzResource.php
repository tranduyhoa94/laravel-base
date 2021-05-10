<?php

namespace App\Http\Resources\Quizz;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Topic\TopicResource;
use App\Http\Resources\Question\QuizzQuestionCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizzResource extends JsonResource
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
            'range_time',
            'status',
            'topic_id',
            'has_mCQ',
            'has_blank',
            'type',
            'number_questions'
        ]);

        $result['topic'] = new TopicResource($this->whenLoaded('topic'));

        $result['blank_questions'] = new QuizzQuestionCollection($this->whenLoaded('blankQuestions'));
        $result['mC_questions'] = new QuizzQuestionCollection($this->whenLoaded('mCQuestions'));
        $result['createdable'] = new AdminResource($this->whenLoaded('createdable'));

        return $result;
    }
}
