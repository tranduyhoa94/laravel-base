<?php

namespace App\Repositories;

use App\Models\Room;
use Ky\Core\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Room::class;
    }
    public function getOrderableFields()
    {
        return [
            'updated_at',
        ];
    }
}
