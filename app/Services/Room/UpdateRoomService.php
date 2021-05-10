<?php

namespace App\Services\Room;

use Illuminate\Support\Facades\Hash;
use Ky\Core\Services\BaseService;
use App\Repositories\RoomRepository;

class UpdateRoomService extends BaseService
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
        $this->model->fill($this->data);
        $this->model->save();

        return $this->model;
    }
}
