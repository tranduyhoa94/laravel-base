<?php

namespace App\Services\Student;

use App\Repositories\StudentRepository;
use Ky\Core\Services\BaseService;

class DeleteStudentService extends BaseService
{

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
        return $this->model->delete();
    }
}
