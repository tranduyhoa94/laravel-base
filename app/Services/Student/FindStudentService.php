<?php

namespace App\Services\Student;

use Ky\Core\Services\BaseService;
use App\Repositories\StudentRepository;
use Ky\Core\Criteria\WithRelationsCriteria;

class FindStudentService extends BaseService
{
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
        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));
        
        return $this->repository->find($this->model);
    }
}
