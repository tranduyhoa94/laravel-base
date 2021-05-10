<?php

namespace App\Http\Requests\Student\Appointment;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use App\Rules\RangeTime;

class StoreAppointmentRequest extends BaseRequest
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
                'email'
            ],
            'phone' => [
                'required',
                'min:'. self::PHONE_MIN_LENGTH,
                'numeric',
                'sometimes',
            ],
            'address' => [
                'string',
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
                'required',
            ],
            'topic_id' => [
                'required',
                'integer',
                Rule::exists('topics', 'id')
            ],
            'slots' => [
                'required',
                'array',
                'max:' . self::MAX_SLOTS
            ],
            'slots.*.start_time' => [
                'required',
                'date',
                'after:today'
            ],
            'slots.*.end_time' => [
                'sometimes',
                'date',
                'after:slots.*.start_time',
                new RangeTime()
            ],
            'comments' => [
                'string',
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'at_center' => [
                'boolean',
                'required'
            ],

        ];
    }
}
