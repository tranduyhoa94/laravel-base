<?php

namespace App\Http\Requests\Student\Quizz;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use App\Models\QuizSession;

class CreateQuizSessionRequest extends BaseRequest
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
            'quizz_id' => [
                'required',
                'integer',
                Rule::exists('quizzes', 'id')
                    ->whereNull('deleted_at')
            ]
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'The selected type not in [mcq, blank] is invalid.'
        ];
    }
}
