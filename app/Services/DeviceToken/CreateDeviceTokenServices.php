<?php

namespace App\Services\DeviceToken;

use App\Repositories\DeviceTokenRepository;
use Ky\Core\Services\BaseService;

class CreateDeviceTokenServices extends BaseService
{
    protected $collectsData = true;

    /** @var \App\Models\Student */
    protected $handler;

    /**
     * @var DeviceTokenRepository
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
        $device = $this->repository->scopeQuery(function ($query) {
            return $query->where('device_id', $this->data->get('device_id'))
                ->where('user_id', $this->handler->id);
        })->first();

        if (!$device) {
            $this->repository->create([
                'user_id' => $this->handler->id,
                'platform' => $this->data->get('platform'),
                'device_token' => $this->data->get('device_token'),
                'device_id' => $this->data->get('device_id')
            ]);
            
            return;
        }
        
        $device->device_token = $this->data->get('device_token');
        $device->save();
    }
}
