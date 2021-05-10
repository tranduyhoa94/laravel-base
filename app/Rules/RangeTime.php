<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class RangeTime implements Rule
{
    /**
     * @var string
     */
    protected $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function passes($attribute, $value)
    {
        $index = explode('.', $attribute)[1];
        $prefix = request()->input("slots.{$index}.start_time");
        $startDateMax = Carbon::parse($prefix)->addHours(2);
        $startDateMin = Carbon::parse($prefix)->addHours(1);
        $endDate = Carbon::parse($value);

        if (!$endDate->between($startDateMin, $startDateMax)) {
            $this->message = __('validation.custom.time');

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    public function __toString()
    {
        return 'RangeTime';
    }
}
