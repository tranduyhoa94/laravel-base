<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\Appointment;

class AppointmentRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Appointment::class;
    }

    public function getOrderableFields()
    {
        return [
            'updated_at',
            'status'
        ];
    }

    /**
     * Get allow relations
     *
     * @return array
     */
    public function getAllowRelations()
    {
        return [
            'slots',
            'topic' => function ($query) {
                return $query->with('subject');
            },
            'teacher'
        ];
    }
}
