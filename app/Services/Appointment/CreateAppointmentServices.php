<?php

namespace App\Services\Appointment;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ky\Core\Services\BaseService;
use App\Repositories\AppointmentRepository;
use App\Repositories\StudentRepository;
use App\Services\HelperStudentTrait;
use App\Events\Appointment\CreateAppointmentEvent;

class CreateAppointmentServices extends BaseService
{
    use HelperStudentTrait;

    protected $collectsData = true;

    /**
     * @var AppointmentRepository
     */
    protected $repository;

    /**
     * @var StudentRepository
     */
    protected $studentRepository;

    public function __construct(
        AppointmentRepository $repository,
        StudentRepository $studentRepository
    ) {
        $this->repository = $repository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->data->put('student_id', $this->handler->id);

        return DB::transaction(function () {
            /** @var \App\Models\Appointment */
            $appointment = $this->repository->create($this->data->toArray());

            $this->updatePhoneNumber();

            if ($this->data->has('slots')) {
                $slots = $this->transformSlots($appointment->id);
                $appointment->slots()->insert($slots);
            }

            // send noti for admin
            event(new CreateAppointmentEvent($appointment));

            return $appointment;
        });
    }

    /**
     * Transport data to appointments slots
     * @return array
     */
    private function transformSlots($appointment_id)
    {
        $now = now();
        return array_map(function ($slot) use ($now, $appointment_id) {
            return [
                'appointment_id' => $appointment_id,
                'start_time' => (new Carbon($slot['start_time']))->setTimezone('UTC'),
                'end_time' => isset($slot['end_time'])
                    ? (new Carbon($slot['end_time']))->setTimezone('UTC')
                    : Carbon::parse($slot['start_time'])->addHours(2),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $this->data->get('slots'));
    }

    private function updatePhoneNumber()
    {
        $this->handler->phone = $this->data->get('phone');
        $this->handler->save();
    }
}
