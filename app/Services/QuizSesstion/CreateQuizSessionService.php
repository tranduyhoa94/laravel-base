<?php

namespace App\Services\QuizSesstion;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;
use App\Repositories\QuizSessionRepository;
use App\Repositories\QuizSessionQuestionRepository;
use App\Repositories\QuizzRepository;
use App\Models\QuizSession;

class CreateQuizSessionService extends BaseService
{
    /** @var \App\Models\Student */
    protected $handler;

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
     * @var QuizzRepository
     */
    protected $quizzRepository;


    public function __construct(
        QuizSessionRepository $repository,
        QuizSessionQuestionRepository $quizzQuestionRepository,
        QuizzRepository $quizzRepository
    ) {
        $this->repository = $repository;
        $this->quizzQuestionRepository = $quizzQuestionRepository;
        $this->quizzRepository = $quizzRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $quizz = $this->quizzRepository->find($this->data->get('quizz_id'));

        $this->transformQuizzSesstion($quizz);

        $questionRandom = $quizz->questions->random($quizz->number_questions);

        return DB::transaction(function () use ($questionRandom) {
            /** @var \App\Models\QuizSession */
            $quizSession = $this->repository->create($this->data->toArray());

            $this->quizzQuestionRepository->insert(
                $this->transformQuizzSesstionQuestions($quizSession->id, $questionRandom)
            );

            return $this->getQuestionByQuizz($quizSession->id);
        });
    }

    /**
     * Transport data to quiz_sesstion
     */
    public function transformQuizzSesstion($quizz)
    {
        $this->data->put("student_id", $this->handler->id);
        $this->data->put("start_time", (Carbon::now())->setTimezone('UTC'));
        $this->data->put("end_time", Carbon::now()->addMinutes($quizz->range_time));
        $this->data->put("name", $quizz->name);
    }

    /**
     * Get list Question by array question ids
     */
    public function getQuestionByQuizz($quiz_sesstion_id)
    {
        return $this->repository->scopeQuery(function ($query) use ($quiz_sesstion_id) {
            return $query->with(
                ['mcqQuestions.question.answerShuffle', 'blankQuestions.question.answerShuffle']
            )->where('id', $quiz_sesstion_id);
        })->all();
    }

    /**
     * Transport data to quiz_sesstion_questions
     */
    public function transformQuizzSesstionQuestions($quiz_sesstion_id, $question)
    {
        $now = now();

        return array_map(function ($quizz_session_question) use ($quiz_sesstion_id, $now) {
            return [
                'type' => $quizz_session_question['type'] === Question::TYPE_SINGLE
                    || $quizz_session_question['type'] === Question::TYPE_MULTIPLE
                    ? QuizSession::TYPE_MCQ
                    : QuizSession::TYPE_BLANK,
                'quiz_session_id' => $quiz_sesstion_id,
                'question_id' => $quizz_session_question['id'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }, $question->toArray());
    }
}
