<?php

namespace App\Http\Requests\Teacher\Quizz;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ListQuizzRequest extends BaseRequest
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
            'status' => [
                'sometimes',
                'string'
            ],
            'topic_id' => [
                'sometimes',
                'integer',
                Rule::exists('topics', 'id')
                    ->whereNull('deleted_at')
            ],
            'type' => [
                'sometimes',
                'string'
            ]
        ]);
    }
}
