<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\UpdateScheduleRequest;
use App\Http\Requests\Admin\Schedule\StoreScheduleRequest;
use App\Http\Requests\Admin\Schedule\FindScheduleRequest;
use App\Http\Requests\Admin\Schedule\DeleteScheduleRequest;
use App\Http\Requests\Admin\Schedule\ListScheduleRequest;
use App\Http\Requests\Admin\Schedule\ActiveScheduleRequest;
use App\Services\Schedule\ActiveScheduleServices;
use App\Services\Schedule\UpdateScheduleService;
use App\Services\Schedule\ListScheduleService;
use App\Services\Schedule\FindScheduleService;
use App\Services\Schedule\DeleteScheduleService;
use App\Services\Schedule\CreateScheduleService;
use App\Http\Resources\Schedule\ScheduleCollection;
use App\Http\Resources\Schedule\ScheduleResource;

class ScheduleController extends Controller
{
    /**
     * @var ListScheduleService
     */
    protected $listService;

    /**
     * @var FindScheduleService
     */
    protected $findService;

    /**
     * @var CreateScheduleService
     */
    protected $createService;

    /**
     * @var UpdateScheduleService
     */
    protected $updateService;

    /**
     * @var DeleteScheduleService
     */
    protected $deleteService;

    /**
     * @var ActiveScheduleServices
     */
    protected $activeScheduleService;

    public function __construct(
        ListScheduleService $listService,
        FindScheduleService $findService,
        CreateScheduleService $createService,
        UpdateScheduleService $updateService,
        DeleteScheduleService $deleteService,
        ActiveScheduleServices $activeScheduleService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->activeScheduleService = $activeScheduleService;
    }

    public function index(ListScheduleRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new ScheduleCollection($items));
    }

    public function store(StoreScheduleRequest $request)
    {
        $this->createService
            ->setRequest($request)
            ->handle();

        return response()->successWithoutData();
    }

    public function show(FindScheduleRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new ScheduleResource($item));
    }

    public function update(UpdateScheduleRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new ScheduleResource($item));
    }

    public function destroy(DeleteScheduleRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->deleteService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function active(ActiveScheduleRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->activeScheduleService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
