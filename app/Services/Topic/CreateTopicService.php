<?php

namespace App\Services\Topic;

use App\Repositories\TopicRepository;
use Illuminate\Support\Facades\Hash;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;

class CreateTopicService extends BaseService
{
    use HelperServiceTrait;

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
        return $this->repository->create($this->data);
    }
}
