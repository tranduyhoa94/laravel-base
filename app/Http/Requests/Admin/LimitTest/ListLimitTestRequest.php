<?php

namespace App\Http\Requests\Admin\LimitTest;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ListLimitTestRequest extends BaseRequest
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
            'subject_id' => [
                'sometimes',
                'integer',
                Rule::exists('subjects', 'id')
            ],
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')
            ]
        ]);
    }
}
