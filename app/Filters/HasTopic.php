<?php

namespace App\Filters;

use Ky\Core\Filters\BaseFilter;

class HasTopic extends BaseFilter
{
    /**
     * Apply the filter
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param mixed $input
     * @return mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public static function apply($model, $input)
    {
        return $model->has('topics');
    }
}
