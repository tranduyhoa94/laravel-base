<?php

namespace App\Filters;

use Ky\Core\Filters\BaseFilter;
use App\Models\Appointment;

class Status extends BaseFilter
{
    /**
     * Apply the filter
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param mixed $input
     * @return mixed
     */
    public static function apply($model, $input)
    {
        $arrayInput = explode(',', $input);
        $input = array_map(function ($status) {
            if ($status == Appointment::STRING_WAITING) {
                return Appointment::STATUS_WAITING;
            }
            if ($status == Appointment::STRING_DENIED) {
                return Appointment::STATUS_DENIED;
            }
            if ($status == Appointment::STRING_APPROVED) {
                return Appointment::STATUS_APPROVED;
            }
        }, $arrayInput);

        return $model->whereIn('status', $input);
    }
}
