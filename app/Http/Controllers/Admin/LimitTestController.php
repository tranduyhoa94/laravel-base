<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LimitTest\StoreLimitTestRequest;
use App\Http\Requests\Admin\LimitTest\ListLimitTestRequest;
use App\Http\Requests\Admin\LimitTest\DeleteLimitTestRequest;
use App\Services\LimitTest\CreateLimitTestService;
use App\Services\LimitTest\ListLimitTestService;
use App\Services\LimitTest\FindLimitTestService;
use App\Services\LimitTest\DeleteLimitTestService;
use App\Http\Resources\LimitTest\LimitTestResource;
use App\Http\Resources\LimitTest\LimitTestCollection;

class LimitTestController extends Controller
{
    public function index(ListLimitTestRequest $request, ListLimitTestService $service)
    {
        return response()->success(new LimitTestCollection($service->setRequest($request)->handle()));
    }

    public function store(StoreLimitTestRequest $request, CreateLimitTestService $service)
    {
        return response()->success(new LimitTestResource($service->setRequest($request)->handle()));
    }

    public function destroy(
        DeleteLimitTestRequest $request,
        FindLimitTestService $findService,
        DeleteLimitTestService $deleteService,
        int $id
    ) {
        $item = $findService->setRequest($request)
            ->setModel($id)
            ->handle();

        $deleteService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
