<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\DeleteAdminRequest;
use App\Http\Requests\Admin\Account\FindAdminRequest;
use App\Http\Requests\Admin\Account\ListAdminRequest;
use App\Http\Requests\Admin\Account\StoreAdminRequest;
use App\Http\Requests\Admin\Account\UpdateAdminRequest;
use App\Http\Requests\Admin\Account\ActiveAdminRequest;
use App\Services\Admin\CreateAdminService;
use App\Services\Admin\DeleteAdminService;
use App\Services\Admin\FindAdminService;
use App\Services\Admin\ListAdminService;
use App\Services\Admin\UpdateAdminService;
use App\Services\Admin\ActiveAdminServices;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Resources\Admin\AdminResource;

class AdminController extends Controller
{
    /**
     * @var ListAdminService
     */
    protected $listService;

    /**
     * @var FindAdminService
     */
    protected $findService;

    /**
     * @var CreateAdminService
     */
    protected $createService;

    /**
     * @var UpdateAdminService
     */
    protected $updateService;

    /**
     * @var DeleteAdminService
     */
    protected $deleteService;

    /**
     * @var ActiveAdminServices
     */
    protected $activeAdminService;

    public function __construct(
        ListAdminService $listService,
        FindAdminService $findService,
        CreateAdminService $createService,
        UpdateAdminService $updateService,
        DeleteAdminService $deleteService,
        ActiveAdminServices $activeAdminService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->activeAdminService = $activeAdminService;
    }

    public function index(ListAdminRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new AdminCollection($items));
    }

    public function store(StoreAdminRequest $request)
    {
        $item = $this->createService
            ->setRequest($request)
            ->handle();

        return response()->success(new AdminResource($item));
    }

    public function show(FindAdminRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new AdminResource($item));
    }

    public function update(UpdateAdminRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new AdminResource($item));
    }

    public function destroy(DeleteAdminRequest $request, int $id)
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

    public function active(ActiveAdminRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->activeAdminService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
