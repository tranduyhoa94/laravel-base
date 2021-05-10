<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\LimitTest;

class LimitTestRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return LimitTest::class;
    }

    public function getAllowRelations()
    {
        return [
            'subjects',
            'students'
        ];
    }
}
