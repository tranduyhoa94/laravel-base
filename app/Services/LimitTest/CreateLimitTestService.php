<?php

namespace App\Services\LimitTest;

use App\Repositories\LimitTestRepository;
use Carbon\Carbon;
use Ky\Core\Services\BaseService;

class CreateLimitTestService extends BaseService
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
        $this->data->put("start_time", (new Carbon($this->data->get("start_time")))->setTimezone('UTC'));
        $this->data->put("end_time", (new Carbon($this->data->get("end_time")))->setTimezone('UTC'));

        return $this->repository->create($this->data->toArray());
    }
}
