<?php

namespace App\Services\Topic;

use App\Repositories\TopicRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\OrderCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;
use Ky\Core\Services\BaseService;

class ListTopicService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var TopicRepository
     */
    protected $repository;

    public function __construct(TopicRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if (!optional($this->handler)->isAdmin()) {
            $this->data->put('is_active', 1);
        };

        $this->repository
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()))
            ->pushCriteria(new OrderCriteria($this->data->get('order')))
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
            'name',
            'subject_id',
            'is_active'
        ];
    }
}
