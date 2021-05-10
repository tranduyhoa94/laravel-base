<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    /**
     * @var string
     */
    protected $regex = '/([+]673)+([0-9]{5,11})\b/';

    /**
     * @var int
     */
    protected $min = 5;

    /**
     * @var int
     */
    protected $max = 11;

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
        switch (true) {
            case (!is_string($value)):
                $this->message = __('validation.string');

                return false;

            case (!preg_match($this->regex, $value)):
                $this->message = __('validation.custom.phone');

                return false;

            default:
                return true;
        }
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

    /**
     * Set min characters
     *
     * @param int $min
     */
    public function setMin(int $min)
    {
        $this->min = $min;
    }

    /**
     * Set min characters
     *
     * @param int $max
     */
    public function setMax(int $max)
    {
        $this->max = $max;
    }

    /**
     * Set regex
     *
     * @param string $regex
     */
    public function setRegex(string $regex)
    {
        $this->regex = $regex;
    }

    public function __toString()
    {
        return 'Phone';
    }
}
