<?php

namespace App\Http\Requests\Admin\Question;

use App\Http\Requests\BaseRequest;
use App\Models\Question;
use Illuminate\Validation\Rule;

class UpdateQuestionRequest extends BaseRequest
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
                'max:' . self::TITLE_MAX_LENGTH
            ],
            'type' => [
                'required',
                'string',
                'min:' . self::TITLE_MIN_LENGTH,
                'max:' . self::TITLE_MAX_LENGTH,
                Rule::in(Question::types())
            ],
            'quizz_id' => [
                'required',
                'integer',
                Rule::exists('quizzes', 'id')
                    ->whereNull('deleted_at')
            ],
            'image_id' => [
                'nullable',
                'integer',
                Rule::exists('images', 'id')
            ],
            'note' => [
                'nullable',
                'string',
                'min:' . self::DESCRIPTION_MIN_LENGTH,
                'max:' . self::DESCRIPTION_MAX_LENGTH
            ],
            'answers' => [
                'sometimes',
                'array'
            ],
            'answers.*.content' => [
                'required',
                'string',
                'min:' . self::DESCRIPTION_MIN_LENGTH,
                'max:' . self::DESCRIPTION_MAX_LENGTH
            ],
            'answers.*.is_correct' => [
                'required',
                'boolean'
            ]
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'The selected type not in [single_choice, multiple_choice, blank] is invalid.'
        ];
    }
}
