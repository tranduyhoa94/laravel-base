<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Topic\UpdateTopicRequest;
use App\Http\Requests\Admin\Topic\StoreTopicRequest;
use App\Http\Requests\Admin\Topic\FindTopicRequest;
use App\Http\Requests\Admin\Topic\DeleteTopicRequest;
use App\Http\Requests\Admin\Topic\ListTopicRequest;
use App\Http\Requests\Admin\Topic\ActiveTopicRequest;
use App\Services\Topic\ActiveTopicServices;
use App\Services\Topic\UpdateTopicService;
use App\Services\Topic\ListTopicService;
use App\Services\Topic\FindTopicService;
use App\Services\Topic\DeleteTopicService;
use App\Services\Topic\CreateTopicService;
use App\Http\Resources\Topic\TopicCollection;
use App\Http\Resources\Topic\TopicResource;

class TopicController extends Controller
{
    /**
     * @var ListTopicService
     */
    protected $listService;

    /**
     * @var FindTopicService
     */
    protected $findService;

    /**
     * @var CreateTopicService
     */
    protected $createService;

    /**
     * @var UpdateTopicService
     */
    protected $updateService;

    /**
     * @var DeleteTopicService
     */
    protected $deleteService;

    /**
     * @var ActiveTopicServices
     */
    protected $activeTopicService;

    public function __construct(
        ListTopicService $listService,
        FindTopicService $findService,
        CreateTopicService $createService,
        UpdateTopicService $updateService,
        DeleteTopicService $deleteService,
        ActiveTopicServices $activeTopicService
    ) {
        $this->listService = $listService;
        $this->findService = $findService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->activeTopicService = $activeTopicService;
    }

    public function index(ListTopicRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new TopicCollection($items));
    }

    public function store(StoreTopicRequest $request)
    {
        $item = $this->createService
            ->setRequest($request)
            ->handle();

        return response()->success(new TopicResource($item));
    }

    public function show(FindTopicRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new TopicResource($item));
    }

    public function update(UpdateTopicRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new TopicResource($item));
    }

    public function destroy(DeleteTopicRequest $request, int $id)
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

    public function active(ActiveTopicRequest $request, int $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->activeTopicService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
