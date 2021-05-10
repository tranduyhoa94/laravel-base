<?php

namespace App\Repositories;

use App\Models\QuizSessionQuestion;
use Ky\Core\Repositories\BaseRepository;

class QuizSessionQuestionRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return QuizSessionQuestion::class;
    }
}
