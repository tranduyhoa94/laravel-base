<?php

namespace App\Services\Teacher;

use App\Repositories\TeacherRepository;
use Ky\Core\Services\BaseService;

class DeleteTeacherService extends BaseService
{

    protected $collectsData = true;

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
        return $this->model->delete();
    }
}
