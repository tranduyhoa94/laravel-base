<?php

namespace App\Services\Schedule;

use Ky\Core\Services\BaseService;
use App\Repositories\ScheduleRepository;

class FindScheduleService extends BaseService
{
    /**
     * @var ScheduleRepository
     */
    protected $repository;

    public function __construct(ScheduleRepository $repository)
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
