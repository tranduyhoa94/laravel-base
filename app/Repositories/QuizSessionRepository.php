<?php

namespace App\Repositories;

use App\Models\QuizSession;
use Ky\Core\Repositories\BaseRepository;

class QuizSessionRepository extends BaseRepository
{
    /**
     * Get the model of repository
     *
     * @return string
     */
    public function getModel()
    {
        return QuizSession::class;
    }

    public function getAllowRelations()
    {
        return [
            'teacher',
            'student',
            'quiz'=> function ($query) {
                return $query->withTrashed()->with('topic.subject');
            }
        ];
    }

    public function getOrderableFields()
    {
        return [
            'updated_at',
            'is_completed',
            'submited_at',
        ];
    }
}
