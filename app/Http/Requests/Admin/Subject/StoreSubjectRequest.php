<?php

namespace App\Http\Requests\Admin\Subject;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreSubjectRequest extends BaseRequest
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
                Rule::unique('subjects', 'name')
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ],
            'topics' => [
                'sometimes',
                'array',
            ],
            'topics.*' => [
                'required',
                'min:' . self::TITLE_MIN_LENGTH,
                'max:' . self::TITLE_MAX_LENGTH,
                Rule::unique('topics', 'name')
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
