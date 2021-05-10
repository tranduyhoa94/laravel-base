<?php

namespace App\Http\Requests\Admin\Room;

use App\Http\Requests\BaseRequest;

class ListRoomRequest extends BaseRequest
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
                'nullable',
                'string'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ],
        ]);
    }
}
