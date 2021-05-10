<?php

namespace App\Http\Requests\Admin\Account;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends BaseRequest
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
                'min:' . self::TITLE_MIN_LENGTH,
                'max:' . self::TITLE_MAX_LENGTH,
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('admins', 'email')
                    ->ignore($this->route('admin'))
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ],
        ];
    }
}
