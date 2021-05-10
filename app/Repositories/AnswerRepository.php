<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\Answer;

class AnswerRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Answer::class;
    }
}
