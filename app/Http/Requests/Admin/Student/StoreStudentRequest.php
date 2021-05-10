<?php

namespace App\Http\Requests\Admin\Student;

use App\Http\Requests\BaseRequest;
use App\Rules\Phone;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends BaseRequest
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
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('students', 'email')->whereNull('deleted_at')
            ],
            'phone' => [
                'sometimes',
                new Phone
            ],
            'gender' => [
                'sometimes',
                'boolean'
            ]
        ];
    }
}
