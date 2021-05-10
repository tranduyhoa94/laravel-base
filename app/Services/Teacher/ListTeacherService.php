<?php

namespace App\Services\Teacher;

use App\Repositories\TeacherRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Services\BaseService;

class ListTeacherService extends BaseService
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
        $this->repository->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));
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
