<?php

namespace App\Services\QuizSesstion;

use App\Exceptions\QuizSessionException;
use App\Models\QuizSession;
use App\Repositories\QuizSessionQuestionRepository;
use App\Repositories\QuizSessionRepository;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;

class ExamineQuizSessionService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var QuizSessionRepository
     */
    protected $repository;

    /**
     * @var QuizSessionQuestionRepository
     */
    protected $quizzQuestionRepository;

    /**
     * @var \App\Models\QuizSession
     */
    protected $model;

    public function __construct(
        QuizSessionRepository $repository,
        QuizSessionQuestionRepository $quizzQuestionRepository
    ) {
        $this->repository = $repository;
        $this->quizzQuestionRepository = $quizzQuestionRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if ($this->model->isCompleted()) {
            throw QuizSessionException::quizSessionHasBeenCompleted();
        }

        $this->examineQuizSession();

        return [
            'success' => true,
            'type' => $this->model->type,
            'message' => __('messages.quiz_session.examine_quiz_success')
        ];
    }

    /**
     * Get list Question
     * @param string $type
     */
    public function getQuizSession(string $type)
    {
        $with = $type === QuizSession::TYPE_MCQ ? 'sessionQuestions.question.answers' : 'sessionQuestions.question';

        return $this->repository->scopeQuery(function ($query) use ($with) {
            return $query->where('id', $this->model->id)->with($with);
        })->first();
    }

    /**
     * @return bool
     */
    private function examineQuizSession():bool
    {
        $quizSession = $this->getQuizSession(QuizSession::TYPE_BLANK);

        $sessionQuestions = $quizSession->sessionQuestions->map(function ($sessionQuestion) {
            $studentResult = collect($this->data->get('session_questions'))
                ->filter(function ($value) use ($sessionQuestion) {
                    return $value['id'] === $sessionQuestion->id;
                })->first();

            if (!$studentResult) {
                return $sessionQuestion;
            }

            $sessionQuestion->is_correct = $studentResult['is_correct'];

            unset($sessionQuestion->question);

            return $sessionQuestion;
        });

        $scope = $this->countQuestion($sessionQuestions);

        return DB::transaction(function () use ($sessionQuestions, $scope, $quizSession) {

            $sessionQuestions->map(function ($value) {
                $value->save();
            });

            $quizSession->scope = $scope;
            $quizSession->is_completed = true;
            $quizSession->save();

            return true;
        });
    }

    public function countQuestion($sessionQuestions)
    {
        $numberCorrect = $sessionQuestions->filter(function ($value) {
            return $value['is_correct'] == 1;
        })->count();

        $scope = $numberCorrect . '/' . $sessionQuestions->count();

        return $scope;
    }
}
