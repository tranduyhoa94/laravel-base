<?php

namespace App\Services;

trait HelperQuestionTrait
{
    /**
     * Transport data to question answers
     * @return array
     */
    public function transformAnswers($question_id)
    {
        return array_map(function ($answer) use ($question_id) {
            return [
                'content' => $answer['content'],
                'question_id' => $question_id,
                'is_correct' => $answer['is_correct']
            ];
        }, $this->data->get('answers'));
    }
}
