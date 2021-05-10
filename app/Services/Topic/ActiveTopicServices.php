<?php

namespace App\Services\Topic;

use App\Repositories\TopicRepository;
use Ky\Core\Services\BaseService;

class ActiveTopicServices extends BaseService
{
    protected $collectsData = true;

    /**
     * @var \App\Repositories\TopicRepository
     */
    protected $repository;

    public function __construct(TopicRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        return $this->model->fill([
            'is_active' => !$this->model->is_active
        ])->save();
    }
}
