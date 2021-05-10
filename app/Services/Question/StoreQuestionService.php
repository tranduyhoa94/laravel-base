<?php

namespace App\Services\Question;

use Ky\Core\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Repositories\QuestionRepository;
use App\Repositories\ImageRepository;
use App\Repositories\AnswerRepository;
use App\Services\HelperQuestionTrait;

class StoreQuestionService extends BaseService
{
    use HelperQuestionTrait;

    protected $collectsData = true;

    /**
     * @var QuestionRepository
     */
    protected $repository;

    /**
     * @var AnswerRepository
     */
    protected $answerRepository;

    /**
     * @var ImageRepository
     */
    protected $imageRepository;

    public function __construct(
        QuestionRepository $repository,
        AnswerRepository $answerRepository,
        ImageRepository $imageRepository
    ) {
        $this->repository = $repository;
        $this->answerRepository = $answerRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return DB::transaction(function () {
            /** @var \App\Models\Question */
            $question = $this->repository->create($this->data->toArray());

            if ($this->data->has('image_id') && $this->data->get('image_id') != null) {
                $this->imageRepository->find($this->data->get('image_id'))
                    ->update([
                        'question_id' => $question->id
                    ]);
            }

            if ($this->data->has('answers')) {
                $answers = $this->transformAnswers($question->id);
                $question->answers()->insert($answers);
            }

            return $question;
        });
    }
}
