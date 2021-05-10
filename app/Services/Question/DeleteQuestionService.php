<?php

namespace App\Services\Question;

use App\Exceptions\QuizzException;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;

class DeleteQuestionService extends BaseService
{
    /** @var Question */
    protected $model;

    /** @var \App\Models\Admin | \App\Models\Teacher*/
    protected $handler;

    protected $collectsData = true;

    /**
     * @var QuestionRepository
     */
    protected $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
//        $this->checkIsApproved();
//        $this->checkQuestionFormQuizHanlder();

        return DB::transaction(function () {
            $this->model->answers()->delete();

            return $this->model->forceDelete();
        });
    }

//    /**
//     * Check question have is approved
//     */
//    private function checkIsApproved()
//    {
//        if (!$this->model->isApproved()) {
//            return true;
//        }
//
//        throw QuizzException::notDeleteQuestion();
//    }

//    /**
//     * Check question from Quiz Handler
//     */
//    private function checkQuestionFormQuizHanlder()
//    {
//        if ($this->model->quizz->createdable_id == $this->handler->id
//            && $this->model->quizz->createdable_type == get_class($this->handler)
//        ) {
//            return true;
//        }
//
//        throw QuizzException::notDeleteQuestionFromHandler();
//    }
}
