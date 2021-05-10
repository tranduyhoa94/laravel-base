<?php

namespace App\Http\Requests\Admin\Subject;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends BaseRequest
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
                Rule::unique('subjects', 'name')->ignore($this->route('subject'))
            ],
            'is_active' => [
                'required',
                'boolean'
            ],
            'color' => [
                'sometimes',
                'string'
            ],
            'code' => [
                'sometimes',
                'string'
            ],
        ];
    }
}
