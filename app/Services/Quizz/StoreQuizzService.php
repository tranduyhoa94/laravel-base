<?php

namespace App\Services\Quizz;

use App\Models\Quizz;
use App\Repositories\QuizzRepository;
use Ky\Core\Services\BaseService;

class StoreQuizzService extends BaseService
{
    /** @var QuizzRepository */
    protected $repository;

    /**
     * @var boolean
     */
    protected $collectsData = true;

    /**
     * @var \App\Models\Admin|\App\Models\Teacher
     */
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
        $this->prepareQuizz();
        return $this->repository->create($this->data->toArray());
    }

    private function prepareQuizz()
    {
        $this->data->put('createdable_id', $this->handler->id);
        $this->data->put('createdable_type', get_class($this->handler));
        $this->data->put('status', Quizz::STATUS_PENDING);
    }
}
