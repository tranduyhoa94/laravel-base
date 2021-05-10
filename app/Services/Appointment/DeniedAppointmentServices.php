<?php

namespace App\Services\Appointment;

use App\Exceptions\AdminsException;
use App\Repositories\AppointmentRepository;
use Ky\Core\Services\BaseService;
use App\Models\Appointment;

class DeniedAppointmentServices extends BaseService
{
    /**
     * @var AppointmentRepository
     */
    protected $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {

        if ($this->model->status == Appointment::STRING_WAITING) {
            return $this->model->fill([
                'status' => Appointment::STATUS_DENIED
            ])->save();
        }

        throw AdminsException::errorAppointmentDenied();
    }
}
