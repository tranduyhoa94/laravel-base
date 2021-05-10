<?php

namespace App\Services\Room;

use Ky\Core\Services\BaseService;
use App\Repositories\RoomRepository;

class FindRoomService extends BaseService
{
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
     */
    public function handle()
    {
        return $this->repository->find($this->model);
    }
}
