<?php

namespace App\Services\Schedule;

use App\Repositories\DeviceTokenRepository;
use App\Services\HelperDeviceTrait;
use Carbon\Carbon;
use Ky\Core\Services\BaseService;
use App\Repositories\ScheduleRepository;
use App\Services\CheckScheduleTrait;
use App\Events\Schedule\UpdateScheduleEvent;

class UpdateScheduleService extends BaseService
{
    use CheckScheduleTrait,
        HelperDeviceTrait;

    protected $collectsData = true;

    /**
     * @var ScheduleRepository
     */
    protected $repository;

    /**
     * @var \App\Repositories\DeviceTokenRepository
     */
    protected $deviceRepository;

    /**
     * @var \App\Models\Schedule
     */
    protected $model;

    public function __construct(ScheduleRepository $repository, DeviceTokenRepository $deviceRepository)
    {
        $this->repository = $repository;
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->data->put("start_time", (new Carbon($this->data->get("start_time")))->setTimezone('UTC'));
        $this->data->put("end_time", (new Carbon($this->data->get("end_time")))->setTimezone('UTC'));
        $this->model->fill($this->data->toArray());
        if ($this->model->isDirty(['room_id', 'teacher_id', 'start_time', 'end_time'])) {
            $this->checkExitRoom();
            $this->checkExitTeacher();
        }
        $this->model->save();

        $devices = $this->deviceRepository->scopeQuery(function ($q) {
            return $q->select('platform', 'device_token');
        })->all();

        $devices = $this->detachDevices($devices);

        $env = env('APP_ENV', 'local');
        // Send notify for student global
        if ($env === 'production') {
            event(new UpdateScheduleEvent($devices));
        }

        return $this->model;
    }
}
