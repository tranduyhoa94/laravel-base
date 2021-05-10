<?php

namespace App\Repositories;

use App\Models\Subject;
use Ky\Core\Repositories\BaseRepository;

class SubjectRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Subject::class;
    }

    /**
     * Get allow relations
     *
     * @return array
     */
    public function getAllowRelations()
    {
        return [
            'topics'
        ];
    }

    public function getOrderableFields()
    {
        return [
            'updated_at',
        ];
    }
}
