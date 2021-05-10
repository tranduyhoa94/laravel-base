<?php

namespace App\Services\Appointment;

use Ky\Core\Services\BaseService;
use App\Repositories\AppointmentRepository;

class FindAppointmentServices extends BaseService
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
        return $this->repository->find($this->model);
    }
}
