<?php

namespace App\Http\Requests\Admin\Appointment;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateApprovedAppointmentRequest extends BaseRequest
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
            'teacher_id' => [
                'required',
                'integer',
                Rule::exists('teachers', 'id')
            ]
        ];
    }
}
