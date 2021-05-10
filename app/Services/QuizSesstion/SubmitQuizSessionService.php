<?php

namespace App\Services\QuizSesstion;

use App\Exceptions\QuizSessionException;
use App\Models\QuizSession;
use App\Repositories\QuizSessionQuestionRepository;
use App\Repositories\QuizSessionRepository;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;

class SubmitQuizSessionService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var QuizSessionRepository
     */
    protected $repository;

    /**
     * @var \App\Models\QuizSession
     */
    protected $model;

    /**
     * @var QuizSessionQuestionRepository
     */
    protected $quizzQuestionRepository;

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
        if ($this->model->isSubmited()) {
            throw QuizSessionException::quizSessionHasBeenSubmited();
        }

        $this->submitBlank();
        $this->submitMCQ();

        return [
            'success' => true,
            'type' => $this->model->type,
            'message' => __('messages.quiz_session.success_submit_mcq')
        ];
    }

    /**
     * Get list Question
     * @param string $type
     */
    public function getQuizSession(string $type)
    {
        $with = $type === QuizSession::TYPE_MCQ ? 'mcqQuestions.question.answers' : 'blankQuestions.question';

        return $this->repository->scopeQuery(function ($query) use ($with) {
            return $query->where('id', $this->model->id)->with($with);
        })->first();
    }

    /**
     * @return bool
     */
    private function submitMCQ()
    {
        // Get quiz session with question and answers of each question
        $quizSession = $this->getQuizSession(QuizSession::TYPE_MCQ);

        $sessionQuestions = $quizSession->sessionQuestions->map(function ($sessionQuestion) {
            // Get quiz session result of student submited
            $studentResult = collect($this->data->get('session_questions'))
                ->filter(function ($value) use ($sessionQuestion) {
                    return $value['id'] === $sessionQuestion->id;
                })->first();

            if (!$studentResult) {
                return $sessionQuestion;
            }

            // Get answers of student submited
            // If will lock like [1,2] or [1], if no choose it will is []
            $chooseAnswers = $studentResult['choose_answers'] ?? [];
            sort($chooseAnswers);

            // Get correct answers from database
            // If will lock like [1,2] or [1]
            $correctAnswers = $sessionQuestion->question->answers->filter(function ($value) {
                return $value['is_correct'] == 1;
            })->pluck('id')->sort()->toArray();

            // Compare if correct -> update true
            if (!empty($chooseAnswers) && empty(array_diff_assoc($chooseAnswers, $correctAnswers))) {
                $sessionQuestion->is_correct = true;
            }

            // Convert to json and insert to database
            $sessionQuestion->choose_answers = isset($studentResult['choose_answers'])
                ? json_encode($studentResult['choose_answers'])
                : null;

            unset($sessionQuestion->question);

            return $sessionQuestion;
        });

        $scope = $this->caculatorScope($sessionQuestions);

        return DB::transaction(function () use ($quizSession, $scope) {

            $quizSession->sessionQuestions->map(function ($value) {
                $value->save();
            });

            $quizSession->scope = $scope;
            $quizSession->is_completed = true;
            $quizSession->submited_at = now();
            $quizSession->save();
        });
    }

    /**
     * @return bool
     */
    private function submitBlank():bool
    {
        $quizSession = $this->getQuizSession(QuizSession::TYPE_BLANK);

        $quizSession->sessionQuestions->map(function ($sessionQuestion) {
            $studentResult = collect($this->data->get('session_questions'))
                ->filter(function ($value) use ($sessionQuestion) {
                    return $value['id'] === $sessionQuestion->id;
                })->first();

            if (!$studentResult) {
                return $sessionQuestion;
            }

            $sessionQuestion->content_answers = $studentResult['content_answers'] ?? null;

            unset($sessionQuestion->question);

            return $sessionQuestion;
        });

        return DB::transaction(function () use ($quizSession) {

            $quizSession->sessionQuestions->map(function ($value) {
                $value->save();
            });

            $quizSession->submited_at = now();
            $quizSession->save();
            return true;
        });
    }

    /**
     * @param \Illuminate\Support\Collection $sessionQuestions
     * @return string
     */
    private function caculatorScope($sessionQuestions):string
    {

        $numberCorrect = $sessionQuestions->filter(function ($value) {
            return $value['is_correct'] == 1;
        })->count();

        $scope = $numberCorrect . '/' . $sessionQuestions->count();

        return $scope;
    }
}
