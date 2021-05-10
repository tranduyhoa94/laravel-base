<?php

namespace App\Http\Requests\Admin\QuizSession;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ListQuizSessionRequest extends BaseRequest
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
        return array_merge($this->commonListRules(), [
            'teacher_id' => [
                'sometimes',
                'integer',
                Rule::exists('teachers', 'id')
            ],
            'student_id' => [
                'sometimes',
                'integer',
                Rule::exists('students', 'id')
            ]
        ]);
    }
}
