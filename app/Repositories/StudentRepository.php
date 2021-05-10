<?php

namespace App\Repositories;

use App\Models\Student;
use Ky\Core\Repositories\BaseRepository;

class StudentRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Student::class;
    }

    public function getAllowRelations()
    {
        return [
            'subjectsTaken' => function ($query) {
                return $query->with('subject');
            }
        ];
    }
}
