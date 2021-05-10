<?php

namespace App\Services\LimitTest;

use App\Repositories\LimitTestRepository;
use Ky\Core\Services\BaseService;

class FindLimitTestService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var LimitTestRepository
     */
    protected $repository;

    public function __construct(LimitTestRepository $repository)
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
