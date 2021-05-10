<?php

namespace App\Http\Requests\Student\Topic;

use App\Http\Requests\BaseRequest;

class ListTopicRequest extends BaseRequest
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
            'name' => [
                'sometimes',
                'string'
            ],
            'subject_id' => [
                'sometimes',
                'integer'
            ]
        ]);
    }
}
