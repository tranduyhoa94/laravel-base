<?php

namespace App\Http\Requests\Student\Quizz;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ListQuizRequest extends BaseRequest
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
