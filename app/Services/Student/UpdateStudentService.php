<?php

namespace App\Services\Student;

use Illuminate\Support\Facades\Hash;
use Ky\Core\Services\BaseService;
use App\Repositories\StudentRepository;

class UpdateStudentService extends BaseService
{

    protected $collectsData = false;

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
        $this->model->fill($this->data);
        $this->model->save();

        return $this->model;
    }
}
