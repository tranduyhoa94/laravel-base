<?php

namespace App\Http\Requests\Admin\SubjectTaken;

use App\Http\Requests\BaseRequest;

class ListSubjectTakenRequest extends BaseRequest
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
            'student_id' => [
                'required',
                'integer'
            ]
        ];
    }
}
