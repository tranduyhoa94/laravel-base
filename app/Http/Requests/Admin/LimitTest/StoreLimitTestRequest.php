<?php

namespace App\Http\Requests\Admin\LimitTest;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreLimitTestRequest extends BaseRequest
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
            'times' => [
                'required',
                'integer',
                'min:' . self::INT_32_MIN,
                'max:' . self::INT_32_MAX,
            ],
            'subject_id' => [
                'required',
                'integer',
                Rule::exists('subjects', 'id')
            ],
            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')
            ],
            'start_time' => [
                'required',
                'date'
            ],
            'end_time' => [
                'required',
                'date'
            ],
        ];
    }
}
