<?php

namespace App\Services\Student;

use App\Jobs\SendPassMail;
use App\Repositories\StudentRepository;
use App\Services\HelperServiceTrait;
use Ky\Core\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class CreateStudentService extends BaseService
{
    use HelperServiceTrait;

    protected $collectsData = true;

    /**
     * @var StudentRepository
     */
    protected $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $password = $this->generatePassword();

        $this->data->put('password', Hash::make($password));
        $this->repository->create($this->data->toArray());
        dispatch(new SendPassMail($this->data->get('email'), $password));
    }
}
