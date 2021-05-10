<?php

namespace App\Http\Requests\Student\DeviceToken;

use App\Http\Requests\BaseRequest;
use App\Models\DeviceToken;
use Illuminate\Validation\Rule;

class StoreDeviceTokenRequest extends BaseRequest
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
            'device_token' => [
                'required',
                'string'
            ],
            'platform' => [
                'required',
                'string',
                Rule::in(DeviceToken::platForms())
            ],
            'device_id' => [
                'required',
                'string'
            ]
        ];
    }
}
