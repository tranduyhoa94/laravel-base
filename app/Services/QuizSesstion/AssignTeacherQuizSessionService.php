<?php

namespace App\Services\QuizSesstion;

use App\Models\QuizSession;
use App\Repositories\QuizSessionRepository;
use Ky\Core\Services\BaseService;
use App\Exceptions\QuizSessionException;

class AssignTeacherQuizSessionService extends BaseService
{
    /** @var QuizSession */
    protected $model;

    protected $collectsData = true;

    /**
     * @var QuizSessionRepository
     */
    protected $repository;

    public function __construct(QuizSessionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->notSubmited();
        $this->ensureHasTeacher();

        return $this->model->fill([
            'teacher_id' => $this->data->get('teacher_id'),
        ])->save();
    }

    private function notSubmited()
    {
        if (!is_null($this->model->submited_at)) {
            return true;
        }

        throw QuizSessionException::notAllowCompletedQuizz();
    }

    private function ensureHasTeacher()
    {
        if (is_null($this->model->teacher_id)) {
            return true;
        }

        throw QuizSessionException::errorExitTeacher();
    }
}
