<?php

namespace App\Services\Appointment;

use App\Jobs\SendPassMail;
use App\Repositories\AppointmentRepository;
use App\Repositories\StudentRepository;
use Ky\Core\Services\BaseService;
use App\Services\HelperStudentTrait;
use Illuminate\Support\Facades\DB;
use App\Services\HelperServiceTrait;

class StoreStudentAppointmentServices extends BaseService
{
    use HelperStudentTrait, HelperServiceTrait;

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
        $appointment = $this->repository->find($this->data);
        $student = $this->getInfoStudent($appointment->email);
        $password = $this->generatePassword();
        $isSendEmail = false;

        DB::transaction(function () use ($student, $appointment, $password, &$isSendEmail) {
            if (!optional($student)->id) {
                $idStudent = $this->studentRepository
                    ->create([
                        'name' => $appointment->name,
                        'email' => $appointment->email,
                        'password' => \Hash::make($password),
                        'gender' => 1
                    ]);
                $isSendEmail = true;
            }
            $email = $appointment->email;
            $this->repository->scopeQuery(function ($query) use ($email) {
                return $query->where('email', $email);
            })->bulkUpdate([
                'student_id' => isset($idStudent) ? $idStudent->id : optional($student)->id
            ]);
        });

        if ($isSendEmail) {
            dispatch(new SendPassMail($appointment->email, $password));
        }
    }
}
