<?php

namespace App\Http\Requests\Password;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SendMailRequest extends BaseRequest
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
            'email' => [
                'bail',
                'required',
                'email',
                Rule::exists($this->getTableFromRoute(), 'email')
            ]
        ];
    }

    /**
     * Return table name of Model
     *
     * @return string
     */
    private function getTableFromRoute()
    {
        if (preg_match('/^(\w+)\.password/', $this->route()->getName(), $matches)) {
            $class = Str::studly($matches[1]);

            $model = '\\App\\Models\\' . $class;

            return (new $model)->getTable();
        }

        // Need to return for swagger
        return '';
    }
}
