<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Teacher\UpdateTeacherRequest;
use App\Http\Requests\Admin\Teacher\StoreTeacherRequest;
use App\Http\Requests\Admin\Teacher\FindTeacherRequest;
use App\Http\Requests\Admin\Teacher\DeleteTeacherRequest;
use App\Http\Requests\Admin\Teacher\ListTeacherRequest;
use App\Http\Requests\Admin\Teacher\ActiveTeacherRequest;
use App\Services\Teacher\ActiveTeacherServices;
use App\Services\Teacher\UpdateTeacherService;
use App\Services\Teacher\ListTeacherService;
use App\Services\Teacher\FindTeacherService;
use App\Services\Teacher\DeleteTeacherService;
use App\Services\Teacher\CreateTeacherService;
use App\Http\Resources\Teacher\TeacherCollection;
use App\Http\Resources\Teacher\TeacherResource;

class TeacherController extends Controller
{
    /**
     * @var ListTeacherService
     */
    protected $listService;

    /**
     * @var FindTeacherService
     */
    protected $findService;

    /**
     * @var CreateTeacherService
     */
    protected $createService;

    /**
     * @var UpdateTeacherService
     */
    protected $updateService;

    /**
     * @var DeleteTeacherService
     */
    protected $deleteService;

    /**
     * @var ActiveTeacherServices
     */
    protected $activeTeacherService;

    public function __construct(
        ListTeacherService $listService,
        FindTeacherService $findService,
        CreateTeacherService $createService,
        UpdateTeacherService $updateService,
        DeleteTeacherService $deleteService,
        ActiveTeacherServices $activeTeacherService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->activeTeacherService = $activeTeacherService;
    }

    public function index(ListTeacherRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new TeacherCollection($items));
    }

    public function store(StoreTeacherRequest $request)
    {
        $this->createService
            ->setRequest($request)
            ->handle();

        return response()->successWithoutData();
    }

    public function show(FindTeacherRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new TeacherResource($item));
    }

    public function update(UpdateTeacherRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new TeacherResource($item));
    }

    public function destroy(DeleteTeacherRequest $request, int $id)
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

    public function active(ActiveTeacherRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->activeTeacherService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
