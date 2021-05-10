<?php

namespace App\Services\Teacher;

use Ky\Core\Services\BaseService;
use App\Repositories\TeacherRepository;

class FindTeacherService extends BaseService
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
        return $this->repository->find($this->model);
    }
}
