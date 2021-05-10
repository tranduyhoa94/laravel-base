<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ky\FCM\Service\FCMService;

class PushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $serviceMethod;

    protected $devices;
    protected $data;

    /**
     * Notification constructor.
     * @param array $devices
     * @param array $data
     */
    public function __construct(array $devices, array $data)
    {
        $this->devices = $devices;
        $this->data = $data;
    }

    /**
     * @param FCMService $service
     */
    public function handle(FCMService $service)
    {
        $service
            ->setDevices($this->devices)
            ->setData($this->data)
            ->handle();
    }
}
