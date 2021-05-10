<?php

namespace App\Http\Requests\Teacher\QuizSession;

use App\Http\Requests\BaseRequest;

class ExamineQuizSessionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'session_questions' => [
                'required',
                'array'
            ],
            'session_questions.*.id' => [
                'required',
                'distinct',
                'integer',
            ],
            'session_questions.*.is_correct' => [
                'required',
                'boolean'
            ]
        ];
    }

    public function ensureQuizSessionQuestionsExits(&$validator)
    {
        if (!$this->inputMustBeExistsInDatabase('session_questions.*.id', 'quiz_session_questions', 'id')) {
            $validator->errors()->add('session_questions', __('validation.exists', [
                'attribute' => __('validation.attributes.session_questions')
            ]));
        }
    }
}
