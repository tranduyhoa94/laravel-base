<?php

namespace App\Http\Requests\Teacher\Calendar;

use App\Http\Requests\BaseRequest;

class ListCalendarRequest extends BaseRequest
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
            'start_time_gte' => [
                'sometimes',
                'date',
            ],
            'start_time_lte' => [
                'sometimes',
                'date',
            ],
            'end_time_gte' => [
                'sometimes',
                'date',
            ],
            'end_time_lte' => [
                'sometimes',
                'date',
            ]
        ]);
    }
}
