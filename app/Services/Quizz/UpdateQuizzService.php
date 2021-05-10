<?php

namespace App\Services\Quizz;

use App\Exceptions\QuizzException;
use App\Models\Quizz;
use App\Repositories\QuizzRepository;
use Ky\Core\Services\BaseService;

class UpdateQuizzService extends BaseService
{
    /** @var Quizz */
    protected $model;

    /**
     * @var boolean
     */
    protected $collectsData = true;

    public function __construct(QuizzRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        // $this->ensureAllowUpdate();
        $this->ensureQuizFromHandler();
        $this->model->fill($this->data->toArray());
        $this->model->save();

        return $this->model;
    }

    // private function ensureAllowUpdate()
    // {
    //     if ($this->model->isPending() || $this->model->isPreapprove()) {
    //         return true;
    //     }

    //     throw QuizzException::notAllowUpdateQuizz();
    // }

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
