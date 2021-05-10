<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\Student\DeviceToken\StoreDeviceTokenRequest;
use App\Services\DeviceToken\CreateDeviceTokenServices;
use App\Http\Controllers\Controller;

class DeviceTokenController extends Controller
{
    public function registerDevices(StoreDeviceTokenRequest $request, CreateDeviceTokenServices $service)
    {
        $service->setRequest($request)->handle();

        return response()->successWithoutData();
    }
}
