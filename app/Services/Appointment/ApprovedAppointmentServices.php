<?php

namespace App\Services\Appointment;

use App\Exceptions\AdminsException;
use App\Repositories\AppointmentRepository;
use App\Repositories\DeviceTokenRepository;
use App\Services\HelperDeviceTrait;
use Ky\Core\Services\BaseService;
use App\Models\Appointment;
use App\Events\Appointment\ApprovedAppointmentEvent;

class ApprovedAppointmentServices extends BaseService
{
    use HelperDeviceTrait;
    /**
     * @var AppointmentRepository
     */
    protected $repository;

    /**
     * @var \App\Repositories\DeviceTokenRepository
     */
    protected $deviceRepository;

    public function __construct(AppointmentRepository $repository, DeviceTokenRepository $deviceRepository)
    {
        $this->repository = $repository;
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if (is_null($this->model->teacher_id)) {
            if ($this->model->status == Appointment::STRING_DENIED) {
                throw AdminsException::errorAppointmentApproved();
            }

            $this->model->fill([
                'status' => Appointment::STATUS_APPROVED,
                'teacher_id' => $this->data['teacher_id'],
                'verified_at' => now()
            ])->save();

            // send noti for user
            $deviceTokens = $this->deviceRepository->scopeQuery(function ($query) {
                return $query->select('platform', 'device_token')
                    ->where('user_id', $this->model->student_id);
            })->all();

            $devices = $this->detachDevices($deviceTokens);

            event(new ApprovedAppointmentEvent($devices, $this->model));

            return;
        }

        throw AdminsException::errorExitTeacher();
    }
}
