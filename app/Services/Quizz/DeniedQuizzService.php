<?php

namespace App\Services\Quizz;

use App\Exceptions\QuizzException;
use App\Models\Quizz;
use App\Repositories\QuizzRepository;
use Ky\Core\Services\BaseService;

class DeniedQuizzService extends BaseService
{
    /** @var Quizz */
    protected $model;

    public function __construct(QuizzRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->quizApproved();
        $this->ensureAllowSubmit();

        $this->model->status = Quizz::STATUS_PREAPROVE;
        $this->model->save();
    }

    private function ensureAllowSubmit()
    {
        if ($this->model->isSubmited()) {
            return true;
        }

        throw QuizzException::notDeniedQuizz();
    }

    private function quizApproved()
    {
        if ($this->model->isApproved()) {
            throw QuizzException::notDeniedQuizzWasApproved();
        }
    }
}
