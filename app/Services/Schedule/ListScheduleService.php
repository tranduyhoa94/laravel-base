<?php

namespace App\Services\Schedule;

use App\Repositories\ScheduleRepository;
use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Criteria\OrderCriteria;
use Ky\Core\Services\BaseService;
use Ky\Core\Criteria\WithRelationsCriteria;

class ListScheduleService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var ScheduleRepository
     */
    protected $repository;

    public function __construct(ScheduleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if (! optional($this->handler)->isAdmin()) {
            $this->data->put('is_active', 1);
        };

        $this->repository
            ->pushCriteria(new OrderCriteria($this->data->get('order')))
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));
        $this->repository->pushCriteria(new WithRelationsCriteria(
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
            'topic_id',
            'room_id',
            'teacher_id',
            'is_active',
            'start_time_gte',
            'start_time_lte',
            'end_time_gte',
            'end_time_lte',
            'name'
        ];
    }
}
