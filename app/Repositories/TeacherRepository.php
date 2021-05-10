<?php

namespace App\Repositories;

use App\Models\Teacher;
use Ky\Core\Repositories\BaseRepository;

class TeacherRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Teacher::class;
    }
}
