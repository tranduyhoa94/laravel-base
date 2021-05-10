<?php

namespace App\Http\Requests\Student\DeviceToken;

use App\Http\Requests\BaseRequest;

class RefreshDeviceTokenRequest extends BaseRequest
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
                'string'
            ],
            'device_id' => [
                'required',
                'integer'
            ]
        ];
    }
}
