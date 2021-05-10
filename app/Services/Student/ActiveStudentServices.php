<?php

namespace App\Services\Student;

use App\Repositories\StudentRepository;
use Ky\Core\Services\BaseService;

class ActiveStudentServices extends BaseService
{
    protected $collectsData = true;

    /**
     * @var \App\Repositories\StudentRepository
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
        return $this->model->fill([
            'is_active' => !$this->model->is_active
        ])->save();
    }
}
