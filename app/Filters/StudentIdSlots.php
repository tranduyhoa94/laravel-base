<?php

namespace App\Filters;

use Ky\Core\Filters\BaseFilter;
use App\Models\Appointment;

class StudentIdSlots extends BaseFilter
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
        return $model->whereHas('appointment', function ($query) use ($input) {
            return $query->whereStudentId($input)->whereStatus(Appointment::STATUS_APPROVED);
        });
    }
}
