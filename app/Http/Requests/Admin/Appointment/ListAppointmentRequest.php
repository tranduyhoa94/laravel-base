<?php

namespace App\Http\Requests\Admin\Appointment;

use App\Http\Requests\BaseRequest;

class ListAppointmentRequest extends BaseRequest
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
            'teacher_id' => [
                'nullable',
                'integer'
            ],
            'status' => [
                'sometimes',
                'string'
            ],
        ]);
    }
}
