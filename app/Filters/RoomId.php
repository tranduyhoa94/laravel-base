<?php

namespace App\Filters;

use Ky\Core\Filters\BaseFilter;

class RoomId extends BaseFilter
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
        return $model->where('room_id', '=', $input);
    }
}
