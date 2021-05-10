<?php

namespace App\Services;

use Illuminate\Support\Collection;

trait HelperDeviceTrait
{
    public function detachDevices(Collection $devices)
    {
        $iosDevice = $devices->filter(function ($value) {
            return $value->platform == 'ios';
        })->pluck('device_token')->toArray();

        $androidDevice = $devices->filter(function ($value) {
            return $value->platform == 'android';
        })->pluck('device_token')->toArray();

        return [
            'ios' => $iosDevice,
            'android' => $androidDevice
        ];
    }
}
