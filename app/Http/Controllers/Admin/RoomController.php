<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Room\DeleteRoomRequest;
use App\Http\Requests\Admin\Room\FindRoomRequest;
use App\Http\Requests\Admin\Room\ListRoomRequest;
use App\Http\Requests\Admin\Room\StoreRoomRequest;
use App\Http\Requests\Admin\Room\UpdateRoomRequest;
use App\Services\Room\FindRoomService;
use App\Services\Room\ListRoomService;
use App\Services\Room\UpdateRoomService;
use App\Services\Room\CreateRoomService;
use App\Services\Room\DeleteRoomService;
use App\Http\Resources\Room\RoomResource;
use App\Http\Resources\Room\RoomCollection;

class RoomController extends Controller
{
    /**
     * @var ListRoomService
     */
    protected $listService;

    /**
     * @var FindRoomService
     */
    protected $findService;

    /**
     * @var CreateRoomService
     */
    protected $createService;

    /**
     * @var UpdateRoomService
     */
    protected $updateService;

    /**
     * @var DeleteRoomService
     */
    protected $deleteService;

    public function __construct(
        ListRoomService $listService,
        FindRoomService $findService,
        CreateRoomService $createService,
        UpdateRoomService $updateService,
        DeleteRoomService $deleteService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
    }

    public function index(ListRoomRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new RoomCollection($items));
    }

    public function store(StoreRoomRequest $request)
    {
        $item = $this->createService
            ->setRequest($request)
            ->handle();

        return response()->success(new RoomResource($item));
    }

    public function show(FindRoomRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new RoomResource($item));
    }

    public function update(UpdateRoomRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new RoomResource($item));
    }

    public function destroy(DeleteRoomRequest $request, int $id)
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
}
