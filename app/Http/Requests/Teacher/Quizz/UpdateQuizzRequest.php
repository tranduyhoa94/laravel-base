<?php

namespace App\Http\Requests\Teacher\Quizz;

use App\Http\Requests\BaseRequest;
use App\Models\Quizz;
use Illuminate\Validation\Rule;

class UpdateQuizzRequest extends BaseRequest
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
            'name' => [
                'required',
                'string',
                'min:' . self::TITLE_MIN_LENGTH,
                'max:' . self::TITLE_MAX_LENGTH,
                Rule::unique('quizzes', 'name')
                    ->whereNull('deleted_at')
                    ->ignore($this->route('quiz'))
            ],
            'topic_id' => [
                'required',
                'integer',
                Rule::exists('topics', 'id')
                    ->whereNull('deleted_at')
            ],
            'range_time' => [
                'required',
                'integer',
                'min:' . Quizz::RANGE_TIME_MIN,
                'max:' . Quizz::RANGE_TIME_MAX,
            ],
            'type' => [
                'required',
                'string',
                Rule::in(Quizz::types())
            ],
            'number_questions' => [
                'required',
                'integer',
                'min:' . Quizz::MIN_NUMBER_QUESTION,
                'max:' . Quizz::MAX_NUMBER_QUESTION
            ]
        ];
    }
}
