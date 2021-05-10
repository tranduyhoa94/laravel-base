<?php

namespace App\Repositories;

use App\Models\SubjectTaken;
use Ky\Core\Repositories\BaseRepository;

class SubjectTakenRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return SubjectTaken::class;
    }
}
