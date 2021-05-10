<?php

namespace App\Http\Requests\Admin\Schedule;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreScheduleRequest extends BaseRequest
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
            'topic_id' => [
                'required',
                'integer',
                Rule::exists('topics', 'id')
            ],
            'room_id' => [
                'required',
                'integer',
                Rule::exists('rooms', 'id')
            ],
            'teacher_id' => [
                'required',
                'integer',
                Rule::exists('teachers', 'id')
            ],
            'is_active' => [
                'required',
                'boolean'
            ],
            'slots' => [
                'required',
                'array',
                'max:' . self::MAX_SLOTS
            ],
            'slots.*.start_time' => [
                'required',
                'date'
            ],
            'slots.*.end_time' => [
                'required',
                'date',
                'after:start_time'
            ],
            'name' => [
                'required',
                'string',
                'min:' . self::TITLE_MIN_LENGTH,
                'max:' . self::TITLE_MAX_LENGTH
            ],
            'repeat_next_weeks' => [
                'sometimes',
                'integer',
                'min:1',
                'max:10',
            ]
        ];
    }
}
