<?php

namespace App\Http\Requests\Student\QuizSession;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\Traits\HasComplexValidation;

class SubmitQuizSessionRequest extends BaseRequest
{
    use HasComplexValidation;

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
            'session_questions.*.choose_answers' => [
                'nullable',
                'array',
            ],
            'session_questions.*.choose_answers.*' => [
                'required',
                'integer',
                'distinct'
            ],
            'session_questions.*.content_answers' => [
                'nullable',
                'string'
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

    public function ensureAnswerExits(&$validator)
    {
        if (!$this->inputMustBeExistsInDatabase('session_questions.*.choose_answers.*', 'answers', 'id')) {
            $validator->errors()->add('session_questions', __('validation.exists', [
                'attribute' => __('validation.attributes.choose_answers')
            ]));
        }
    }
}
