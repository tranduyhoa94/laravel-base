<?php

namespace App\Services\Topic;

use Illuminate\Support\Facades\Hash;
use Ky\Core\Services\BaseService;
use App\Repositories\TopicRepository;

class UpdateTopicService extends BaseService
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
        $this->model->fill($this->data);
        $this->model->save();

        return $this->model;
    }
}
