<?php

namespace App\Services\Quizz;

use App\Exceptions\QuizzException;
use App\Models\Quizz;
use App\Models\Question;
use App\Repositories\QuizzRepository;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;

class ApprovedQuizzServices extends BaseService
{
    /** @var Quizz */
    protected $model;

    /** @var \App\Models\Admin */
    protected $handler;

    public function __construct(QuizzRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->ensureCorrectNumberQuestions();
//        $this->notApproved();
        $this->ensureAllowSubmit();

        return DB::transaction(function () {
            $this->model->status = Quizz::STATUS_APPROVED;
            $this->model->save();

            $this->model->questions()->update([
                'is_approved' => Question::IS_APPROVED
            ]);
        });
    }

    private function ensureCorrectNumberQuestions()
    {
        if ($this->model->number_questions > $this->model->questions->count()) {
            throw QuizzException::numberQuestionsNotCorrect();
        }
    }

    private function ensureAllowSubmit()
    {
        if ($this->handler->isAdmin()) {
            return true;
        }

        if ($this->model->isSubmited()) {
            return true;
        }

        if ($this->model->isSubmited()) {
            return true;
        }

        throw QuizzException::notAllowApprovedQuizz();
    }

//    private function notApproved()
//    {
//        if ($this->model->isApproved()) {
//            throw QuizzException::notAllowApprovedQuizzHaveApproved();
//        }
//    }
}
