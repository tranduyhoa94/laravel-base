<?php

namespace App\Services\Student;

use App\Repositories\StudentRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ListStudentService extends BaseService
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
        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));
        
        $this->repository->pushCriteria(new WithRelationsCriteria(
            $this->data->get('with'),
            $this->repository->getAllowRelations()
        ));

        return $this->repository->paginate($this->getPerPage());
    }

    public function getAllowFilters()
    {
        return [
            'name',
            'email',
            'is_active'
        ];
    }
}
