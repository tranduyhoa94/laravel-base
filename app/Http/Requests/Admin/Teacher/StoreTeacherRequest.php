<?php

namespace App\Http\Requests\Admin\Teacher;

use App\Http\Requests\BaseRequest;
use App\Rules\Phone;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends BaseRequest
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
                Rule::unique('teachers', 'email')->whereNull('deleted_at')
            ],
            'phone' => [
                'sometimes',
                new Phone
            ],
            'gender' => [
                'sometimes',
                'boolean'
            ],
            'address' => [
                'sometimes',
                'string',
                'max:'. self::TITLE_MAX_LENGTH,
            ]
        ];
    }
}
