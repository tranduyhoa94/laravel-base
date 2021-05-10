<?php

namespace App\Services\Topic;

use Ky\Core\Services\BaseService;
use App\Repositories\TopicRepository;

class FindTopicService extends BaseService
{
    /**
     * @var TopicRepository
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
        return $this->repository->find($this->model);
    }
}
