<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\UpdateStudentRequest;
use App\Http\Requests\Admin\Student\StoreStudentRequest;
use App\Http\Requests\Admin\Student\FindStudentRequest;
use App\Http\Requests\Admin\Student\DeleteStudentRequest;
use App\Http\Requests\Admin\Student\ListStudentRequest;
use App\Http\Requests\Admin\Student\ActiveStudentRequest;
use App\Services\Student\ActiveStudentServices;
use App\Services\Student\UpdateStudentService;
use App\Services\Student\ListStudentService;
use App\Services\Student\FindStudentService;
use App\Services\Student\DeleteStudentService;
use App\Services\Student\CreateStudentService;
use App\Http\Resources\Student\StudentCollection;
use App\Http\Resources\Student\StudentResource;

class StudentController extends Controller
{
    /**
     * @var ListStudentService
     */
    protected $listService;

    /**
     * @var FindStudentService
     */
    protected $findService;

    /**
     * @var CreateStudentService
     */
    protected $createService;

    /**
     * @var UpdateStudentService
     */
    protected $updateService;

    /**
     * @var DeleteStudentService
     */
    protected $deleteService;

    /**
     * @var ActiveStudentServices
     */
    protected $activeStudentService;

    public function __construct(
        ListStudentService $listService,
        FindStudentService $findService,
        CreateStudentService $createService,
        UpdateStudentService $updateService,
        DeleteStudentService $deleteService,
        ActiveStudentServices $activeStudentService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->activeStudentService = $activeStudentService;
    }

    public function index(ListStudentRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new StudentCollection($items));
    }

    public function store(StoreStudentRequest $request)
    {
        $this->createService
            ->setRequest($request)
            ->handle();

        return response()->successWithoutData();
    }

    public function show(FindStudentRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new StudentResource($item));
    }

    public function update(UpdateStudentRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new StudentResource($item));
    }

    public function destroy(DeleteStudentRequest $request, int $id)
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

    public function active(ActiveStudentRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->activeStudentService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
