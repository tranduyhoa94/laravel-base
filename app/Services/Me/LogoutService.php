<?php

namespace App\Services\Me;

use App\Repositories\DeviceTokenRepository;
use Ky\Core\Services\BaseService;

class LogoutService extends BaseService
{
    protected $collectsData = true;

    /**
     * @var StudentRepository
     */
    protected $repository;

    public function __construct(DeviceTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Logic to handle the data
     */
    public function handle()
    {
        if ($this->data->get('device_id')) {
            $device =  $this->repository->scopeQuery(function ($q) {
                return $q->where('device_id', $this->data->get('device_id'))
                    ->where('user_id', $this->handler->id);
            })->first();

            if ($device) {
                return $device->delete();
            }
        }
    }
}
