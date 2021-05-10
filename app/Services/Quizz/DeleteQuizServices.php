<?php

namespace App\Services\Quizz;

use App\Models\Quizz;
use App\Repositories\AnswerRepository;
use App\Repositories\QuizzRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;

class DeleteQuizServices extends BaseService
{
    /** @var Quizz */
    protected $model;

    /**
     * @var boolean
     */
    protected $collectsData = true;

    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @var AnswerRepository
     */
    protected $answerRepository;

    public function __construct(
        QuizzRepository $repository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository
    ) {
        $this->repository = $repository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        // $this->ensureAllowDelete();

        return DB::transaction(function () {

            return $this->model->delete();
        });
    }

    // private function ensureAllowDelete()
    // {
    //     if ($this->model->isPending() || $this->model->isPreapprove() ||$this->model->isApproved()) {
    //         return true;
    //     }

    //     throw QuizzException::notAllowDeleteQuizz();
    // }
}
