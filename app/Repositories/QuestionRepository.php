<?php

namespace App\Repositories;

use Ky\Core\Repositories\BaseRepository;
use App\Models\Question;

class QuestionRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Question::class;
    }

    public function getAllowRelations()
    {
        return [
            'answers',
            'imageUrl'
        ];
    }
}
