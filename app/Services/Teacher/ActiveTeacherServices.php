<?php

namespace App\Services\Teacher;

use App\Repositories\TeacherRepository;
use Ky\Core\Services\BaseService;

class ActiveTeacherServices extends BaseService
{
    protected $collectsData = true;

    /**
     * @var \App\Repositories\TeacherRepository
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
        return $this->model->fill([
            'is_active' => !$this->model->is_active
        ])->save();
    }
}
