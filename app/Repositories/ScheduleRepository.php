<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\Schedule;

class ScheduleRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Schedule::class;
    }

    public function getAllowRelations()
    {
        return [
            'topic' => function ($query) {
                return $query->with('subject');
            },
            'room',
            'teacher'
        ];
    }

    public function getOrderableFields()
    {
        return [
            'updated_at',
        ];
    }
}
