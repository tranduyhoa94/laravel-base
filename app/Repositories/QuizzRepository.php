<?php

namespace App\Repositories;

use App\Models\Quizz;
use Ky\Core\Repositories\BaseRepository;

class QuizzRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return Quizz::class;
    }

    public function getAllowRelations()
    {
        return [
            'topic',
            'mCQuestions' => function ($query) {
                return $query->with('answers');
            },
            'blankQuestions'  => function ($query) {
                return $query->with('answers');
            },
            'createdable'
        ];
    }

    public function getOrderableFields()
    {
        return [
            'status'
        ];
    }
}
