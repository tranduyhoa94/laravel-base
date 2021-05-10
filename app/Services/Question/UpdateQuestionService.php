<?php

namespace App\Services\Question;

use App\Exceptions\QuizzException;
use App\Models\Question;
use App\Repositories\ImageRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Services\UploadS3Trait;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;
use App\Services\HelperQuestionTrait;

class UpdateQuestionService extends BaseService
{
    use HelperQuestionTrait;
    use UploadS3Trait;

    protected $collectsData = true;

    /** @var Question */
    protected $model;

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
        $this->checkIsApproved();

        return DB::transaction(function () {
            if ($this->data->has('image_id')) {
                /** Remove item image */
                if (!is_null($this->model->imageUrl)) {
                    if ($this->model->imageUrl->id != $this->data->get('image_id')) {
                        $this->deleleImageS3('images/normal/'.$this->model->imageUrl->path);
                        $this->deleleImageS3('images/medium/'.$this->model->imageUrl->path);
                        $this->deleleImageS3('images/full/'.$this->model->imageUrl->path);
                        $this->model->imageUrl->delete();
                    }
                }
                /** Update question id for image */
                if ($this->data->get('image_id') != null) {
                    $this->imageRepository->find($this->data->get('image_id'))
                        ->update([
                            'question_id' => $this->model->id
                        ]);
                }
            }
            $this->model->fill($this->data->toArray());
            $this->model->save();

            if ($this->data->has('answers')) {
                $answers = $this->transformAnswers($this->model->id);
                $this->model->answers()->delete();
                $this->model->answers()->insert($answers);
            }
        });
    }

    /**
     * Check question have is approved
     */
    private function checkIsApproved()
    {
        if (!$this->model->isApproved()) {
            return true;
        }

        throw QuizzException::errorQuestionApproved();
    }
}
