<?php

namespace App\Services\Schedule;

use App\Events\Schedule\CreateScheduleEvent;
use App\Exceptions\AdminsException;
use App\Repositories\ScheduleRepository;
use App\Repositories\DeviceTokenRepository;
use Carbon\Carbon;
use Ky\Core\Services\BaseService;
use App\Services\CheckScheduleTrait;
use App\Services\HelperDeviceTrait;

class CreateScheduleService extends BaseService
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
       $now = now();

       $slots = $this->repeatNextWeeks($this->data->get('repeat_next_weeks'));

       $this->checkExitRoom($slots);
       $this->checkExitTeacher($slots);

       $schedules = $this->transferDataSchedules($now, $slots);

       $this->repository->insert($schedules);

        // Get all device_token Student
        $devices = $this->deviceRepository->scopeQuery(function ($q) {
            return $q->select('platform', 'device_token');
        })->all();

        $devices = $this->detachDevices($devices);

        $env = env('APP_ENV', 'local');
        // Send notify for student global
        if ($env === 'production') {
            event(new CreateScheduleEvent($devices));
        }
    }

    public function transferDataSchedules(Carbon $now, array $slots)
    {
        return array_map(function ($value) use ($now) {
            return [
                'topic_id' => $this->data->get('topic_id'),
                'room_id' => $this->data->get('room_id'),
                'teacher_id' => $this->data->get('teacher_id'),
                'is_active' => $this->data->get('is_active'),
                'name' => $this->data->get('name'),
                'start_time' => (new Carbon($value['start_time']))->setTimezone('UTC'),
                'end_time' => (new Carbon($value['end_time']))->setTimezone('UTC'),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $slots);
    }

    private function repeatNextWeeks($repeat = 0)
    {
        $slots = [];

        for ($i = 0; $i <= $repeat; $i++) {
            $slots = array_merge(array_map(function ($value) use ($i) {
                return [
                    'start_time' => (new Carbon($value['start_time']))->addDays(7*$i)->setTimezone('UTC'),
                    'end_time' => (new Carbon($value['end_time']))->addDays(7*$i)->setTimezone('UTC'),
                ];
            }, $this->data->get('slots')), $slots);
        }

        return $slots;
    }

    private function checkExitRoom($slots)
    {
        $exists = $this->repository->scopeQuery(function ($query) use ($slots) {
            return $query->where('room_id', $this->data->get('room_id'))
                ->where(function ($query) use ($slots) {
                    foreach ($slots as $slot) {
                        $query->orWhere(function ($q) use ($slot) {
                                $q->where('start_time', '<', $slot['end_time'])
                                    ->where('end_time', '>', $slot['start_time']);
                        });
                    }
                });
        })->exists();

        if ($exists) {
            throw AdminsException::errorCheckExitScheduleRoom();
        }
    }

    private function checkExitTeacher($slots)
    {
        $exists = $this->repository->scopeQuery(function ($query) use ($slots) {
            return $query->where('teacher_id', $this->data->get('teacher_id'))
                ->where(function ($query) use ($slots) {
                    foreach ($slots as $slot) {
                        $query->orWhere(function ($q) use ($slot) {
                                $q->where('start_time', '<', $slot['end_time'])
                                    ->where('end_time', '>', $slot['start_time']);
                        });
                    }
                });
        })->exists();

        if ($exists) {
            throw AdminsException::errorCheckExitScheduleTeacher();
        }
    }
}
