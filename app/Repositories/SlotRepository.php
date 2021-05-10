<?php

namespace App\Repositories;

use App\Models\Slot;
use Ky\Core\Repositories\BaseRepository;

class SlotRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Slot::class;
    }

    /**
     * Get allow relations
     *
     * @return array
     */
    public function getAllowRelations()
    {
        return [
            'appointment' => function ($query) {
                return $query->with(['teacher', 'topic.subject']);
            },
        ];
    }
}
