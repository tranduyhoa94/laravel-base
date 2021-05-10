<?php

namespace App\Services\Subject;

use Ky\Core\Services\BaseService;
use App\Repositories\SubjectRepository;

class FindSubjectService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var SubjectRepository
     */
    protected $repository;

    public function __construct(SubjectRepository $repository)
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
