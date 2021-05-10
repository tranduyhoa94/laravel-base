<?php

namespace App\Services\Schedule;

use App\Repositories\ScheduleRepository;
use Ky\Core\Services\BaseService;

class ActiveScheduleServices extends BaseService
{
    protected $collectsData = true;

    /**
     * @var \App\Repositories\ScheduleRepository
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
        return $this->model->fill([
            'is_active' => !$this->model->is_active
        ])->save();
    }
}
