<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Quizz\ListQuizzesRequest;
use App\Http\Requests\Admin\Quizz\ShowQuizzRequest;
use App\Http\Requests\Admin\Quizz\StoreQuizzRequest;
use App\Http\Requests\Admin\Quizz\SubmitQuizzRequest;
use App\Http\Requests\Admin\Quizz\ApprovedQuizzRequest;
use App\Http\Requests\Admin\Quizz\DeniedQuizzRequest;
use App\Http\Requests\Admin\Quizz\UpdateQuizzRequest;
use App\Http\Requests\Admin\Quizz\DeleteQuizRequest;
use App\Http\Resources\Quizz\QuizzCollection;
use App\Http\Resources\Quizz\QuizzResource;
use App\Services\Quizz\DeleteQuizServices;
use App\Services\Quizz\ListQuizzService;
use App\Services\Quizz\ShowQuizzService;
use App\Services\Quizz\StoreQuizzService;
use App\Services\Quizz\SubmitQuizzService;
use App\Services\Quizz\ApprovedQuizzServices;
use App\Services\Quizz\DeniedQuizzService;
use App\Services\Quizz\UpdateQuizzService;

class QuizzController extends Controller
{
    public function index(ListQuizzesRequest $request, ListQuizzService $service)
    {
        return response()->success(new QuizzCollection($service->setRequest($request)->handle()));
    }

    public function store(StoreQuizzRequest $request, StoreQuizzService $service)
    {
        $item = $service->setRequest($request)->handle();

        return response()->success(new QuizzResource($item));
    }

    public function show(ShowQuizzRequest $request, ShowQuizzService $service, int $id)
    {
        $item = $service->setRequest($request)
            ->setModel($id)
            ->handle();

        return response()->success(new QuizzResource($item));
    }

    public function submit(
        SubmitQuizzRequest $request,
        SubmitQuizzService $submitService,
        ShowQuizzService $showService,
        int $id
    ) {
        $item = $showService->setRequest($request)
            ->setModel($id)
            ->handle();

        $submitService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function updateApprovedQuizz(
        ApprovedQuizzRequest $request,
        ShowQuizzService $showService,
        ApprovedQuizzServices $approvedService,
        int $id
    ) {
        $item = $showService->setRequest($request)
            ->setModel($id)
            ->handle();

        $approvedService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function updateDeniedQuizz(
        DeniedQuizzRequest $request,
        ShowQuizzService $showService,
        DeniedQuizzService $deniedService,
        int $id
    ) {
        $item = $showService->setRequest($request)
            ->setModel($id)
            ->handle();

        $deniedService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function update(
        UpdateQuizzRequest $request,
        ShowQuizzService $service,
        UpdateQuizzService $updateService,
        int $id
    ) {
        $item = $service->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $updateService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new QuizzResource($item));
    }

    public function destroy(
        DeleteQuizRequest $request,
        ShowQuizzService $service,
        DeleteQuizServices $deleteService,
        int $id
    ) {
        $item = $service->setRequest($request)
            ->setModel($id)
            ->handle();

        $deleteService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
