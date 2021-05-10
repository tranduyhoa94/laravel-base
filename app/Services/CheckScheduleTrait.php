<?php

namespace App\Services;

use App\Exceptions\AdminsException;

trait CheckScheduleTrait
{
    public function checkExitRoom()
    {
        $rooms = $this->repository->scopeQuery(function ($query) {
            return $query->where('room_id', $this->data->get('room_id'))
                ->where(function ($query) {
                    $query->where('start_time', '<', $this->data->get('end_time'))
                        ->where('end_time', '>', $this->data->get('start_time'));
                });
        })->exists();

        if ($rooms) {
            throw AdminsException::errorCheckExitScheduleRoom();
        }
    }

    public function checkExitTeacher()
    {
        $teacher = $this->repository->scopeQuery(function ($query) {
            return $query->where('teacher_id', $this->data->get('teacher_id'))
                ->where(function ($query) {
                    $query->where('start_time', '<', $this->data->get('end_time'))
                        ->where('end_time', '>', $this->data->get('start_time'));
                });
        })->exists();

        if ($teacher) {
            throw AdminsException::errorCheckExitScheduleTeacher();
        }
    }
}
