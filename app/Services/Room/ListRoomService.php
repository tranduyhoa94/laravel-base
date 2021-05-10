<?php

namespace App\Services\Room;

use Ky\Core\Criteria\FilterCriteria;
use Ky\Core\Services\BaseService;
use App\Repositories\RoomRepository;
use Ky\Core\Criteria\OrderCriteria;
use Ky\Core\Criteria\WithRelationsCriteria;

class ListRoomService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var RoomRepository
     */
    protected $repository;

    public function __construct(RoomRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     *
     */
    public function handle()
    {
        $this->repository
            ->pushCriteria(new OrderCriteria($this->data->get('order')))
            ->pushCriteria(new FilterCriteria($this->data->toArray(), $this->getAllowFilters()));

        return isset($this->data['per_page']) ?
            $this->repository->paginate($this->getPerPage()) :
            $this->repository->all();
    }

    public function getAllowFilters()
    {
        return [
            'name',
            'address',
            'is_active'
        ];
    }
}
