<?php

namespace App\Services\Teacher;

use Illuminate\Support\Facades\Hash;
use Ky\Core\Services\BaseService;
use App\Repositories\TeacherRepository;

class UpdateTeacherService extends BaseService
{

    protected $collectsData = false;

    /**
     * @var TeacherRepository
     */
    protected $repository;

    public function __construct(TeacherRepository $repository)
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
