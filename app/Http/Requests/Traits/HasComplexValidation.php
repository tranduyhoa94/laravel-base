<?php

namespace App\Http\Requests\Traits;

trait HasComplexValidation
{
    protected function withValidator($validator)
    {
        return $validator->after(function ($validator) {
            if (! $validator->errors()->isEmpty()) {
                return $validator;
            }

            $customValidators = preg_grep('/^ensure/', get_class_methods($this));

            foreach ($customValidators as $v) {
                $this->$v($validator);

                if (! $validator->errors()->isEmpty()) {
                    return $validator;
                }
            }
        });
    }
}
