<?php

namespace App\Http\Requests\Admin\AboutUs;

use App\Http\Requests\BaseRequest;

class UpdateAboutUsRequest extends BaseRequest
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
            'title' => [
                'required',
                'string',
                'min:'. self::TITLE_MIN_LENGTH,
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'description' => [
                'required',
                'string',
                'min:'. self::DESCRIPTION_MIN_LENGTH,
                'max:'. self::DESCRIPTION_MAX_LENGTH
            ],
            'facebook_path' => [
                'sometimes',
                'string',
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'instagram_path' => [
                'sometimes',
                'string',
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'youtube_path' => [
                'sometimes',
                'string',
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'twitter_path' => [
                'sometimes',
                'string',
                'max:'. self::TITLE_MAX_LENGTH,
            ],
            'email_us' => [
                'required',
                'string',
                'email'
            ],
            'phone_us' => [
                'sometimes',
                'string',
                'max:'. self::PHONE_MIN_LENGTH,
            ],
            'address_us' => [
                'required',
                'string',
                'min:'. self::DESCRIPTION_MIN_LENGTH,
                'max:'. self::DESCRIPTION_MAX_LENGTH
            ]
        ];
    }
}
