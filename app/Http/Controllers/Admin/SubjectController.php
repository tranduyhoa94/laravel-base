<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subject\DeleteSubjectRequest;
use App\Http\Requests\Admin\Subject\FindSubjectRequest;
use App\Http\Requests\Admin\Subject\ListSubjectRequest;
use App\Http\Requests\Admin\Subject\StoreSubjectRequest;
use App\Http\Requests\Admin\Subject\UpdateSubjectRequest;
use App\Http\Requests\Admin\Subject\ActiveSubjectRequest;
use App\Services\Subject\ActiveSubjectServices;
use App\Services\Subject\FindSubjectService;
use App\Services\Subject\ListSubjectService;
use App\Services\Subject\UpdateSubjectService;
use App\Services\Subject\CreateSubjectService;
use App\Services\Subject\DeleteSubjectService;
use App\Http\Resources\Subject\SubjectResource;
use App\Http\Resources\Subject\SubjectCollection;

class SubjectController extends Controller
{
    /**
     * @var ListSubjectService
     */
    protected $listService;

    /**
     * @var FindSubjectService
     */
    protected $findService;

    /**
     * @var CreateSubjectService
     */
    protected $createService;

    /**
     * @var UpdateSubjectService
     */
    protected $updateService;

    /**
     * @var DeleteSubjectService
     */
    protected $deleteService;

    /**
     * @var ActiveSubjectServices
     */
    protected $activeSubjectService;

    public function __construct(
        ListSubjectService $listService,
        FindSubjectService $findService,
        CreateSubjectService $createService,
        UpdateSubjectService $updateService,
        DeleteSubjectService $deleteService,
        ActiveSubjectServices $activeSubjectService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->activeSubjectService = $activeSubjectService;
    }

    public function index(ListSubjectRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new SubjectCollection($items));
    }

    public function store(StoreSubjectRequest $request)
    {
        $item = $this->createService
            ->setRequest($request)
            ->handle();

        return response()->success(new SubjectResource($item));
    }

    public function show(FindSubjectRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new SubjectResource($item));
    }

    public function update(UpdateSubjectRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new SubjectResource($item));
    }

    public function destroy(DeleteSubjectRequest $request, int $id)
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

    public function active(ActiveSubjectRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->activeSubjectService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
