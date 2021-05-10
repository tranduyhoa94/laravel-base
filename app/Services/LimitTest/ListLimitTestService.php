<?php

namespace App\Services\LimitTest;

use App\Repositories\LimitTestRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ListLimitTestService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var LimitTestRepository
     */
    protected $repository;

    public function __construct(LimitTestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        $this->repository
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()))
            ->pushCriteria(new WithRelationsCriteria(
                $this->data->get('with'),
                $this->repository->getAllowRelations()
            ));

        return $this->data->has('per_page') ?
            $this->repository->paginate($this->getPerPage()) :
            $this->repository->all();
    }

    public function getAllowFilters()
    {
        return [
            'subject_id',
            'student_id'
        ];
    }
}
