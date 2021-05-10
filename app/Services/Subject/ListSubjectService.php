<?php

namespace App\Services\Subject;

use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Services\BaseService;
use App\Repositories\SubjectRepository;
use Ky\Core\Criteria\OrderCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;

class ListSubjectService extends BaseService
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
     *
     */
    public function handle()
    {

        if (! optional($this->handler)->isAdmin()) {
            $this->data->put('is_active', 1);
            $this->data->put('has_topic', 1);
        };

        $this->repository
            ->pushCriteria(new OrderCriteria($this->data->get('order')))
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));

        if ($this->requireTopicsCount()) {
            $this->repository->pushCriteria(new WithRelationsCriteria(
                'topics',
                $this->repository->getAllowRelations()
            ));
        }

        return isset($this->data['per_page']) ?
            $this->repository->paginate($this->getPerPage()) :
            $this->repository->all();
    }

    public function getAllowFilters()
    {
        return [
            'name',
            'is_active',
            'has_topic'
        ];
    }

    /**
     * @return boolean
     */
    private function requireTopicsCount()
    {
        return preg_match('/(?<=^|,)topics_count(?=,|$)/', $this->data->get('with'));
    }
}
