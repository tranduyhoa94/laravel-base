<?php

namespace App\Services\Quizz;

use App\Exceptions\QuizzException;
use App\Models\Quizz;
use App\Repositories\QuizzRepository;
use Ky\Core\Services\BaseService;

class SubmitQuizzService extends BaseService
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
//        $this->ensureAllowSubmit();
        $this->ensureQuizFromHandler();
        if (!$this->model->isApproved()) {
            $this->model->status = Quizz::STATUS_SUBMITED;
        }
        $this->model->save();
    }

    private function ensureAllowSubmit()
    {
        if ($this->model->isPending() || $this->model->isPreapprove()) {
            return true;
        }

        throw QuizzException::notAllowSubmitQuizz();
    }

    private function ensureQuizFromHandler()
    {
        if ($this->model->createdable_id == $this->handler->id
            && $this->model->createdable_type == get_class($this->handler)
        ) {
            return true;
        }

        throw QuizzException::notFromHandler();
    }
}
