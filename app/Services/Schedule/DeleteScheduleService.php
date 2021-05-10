<?php

namespace App\Services\Schedule;

use App\Repositories\ScheduleRepository;
use Ky\Core\Services\BaseService;

class DeleteScheduleService extends BaseService
{

    protected $collectsData = true;

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
        return $this->model->delete();
    }
}
