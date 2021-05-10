<?php

namespace App\Repositories;

use App\Models\Topic;
use Ky\Core\Repositories\BaseRepository;

class TopicRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Topic::class;
    }

    public function getOrderableFields()
    {
        return [
            'updated_at',
            'subject_id',
            'name'
        ];
    }

    public function getAllowRelations()
    {
        return [
            'subject'
        ];
    }
}
