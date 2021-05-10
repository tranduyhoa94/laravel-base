<?php

namespace App\Http\Requests\Admin\SubjectTaken;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\Traits\HasComplexValidation;

class UpdateStudentSubjectTakenRequest extends BaseRequest
{
    use HasComplexValidation;
    
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
            'ids' => [
                'nullable',
                'array'
            ],
            'ids.*' => [
                'required',
                'integer',
                'distinct'
            ]
        ];
    }

    public function ensureSubjectsTakenExits(&$validator)
    {
        if (!$this->inputMustBeExistsInDatabase('ids.*', 'subjects', 'id')) {
            $validator->errors()->add('ids', __('validation.exists', [
                'attribute' => __('validation.attributes.subjects_taken')
            ]));
        }
    }
}
