<?php

namespace App\Services;

use Carbon\Carbon;

trait PrepareDataTrait
{
    public function prepareCreatedBy()
    {
        $this->data->put('created_by', $this->handler->name);
    }

    public function prepareCreateTime()
    {
        if (!$this->data->get('end_time')) {
            $this->data->put('end_time', Carbon::parse($this->data->get('start_time'))->addHours(2)
                ->format('Y-m-d H:i:s'));
        }
    }
}
