<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quizz\QuizzResource;
use App\Http\Resources\Quizz\QuizzCollection;
use App\Services\Quizz\StoreQuizzService;
use App\Services\Quizz\ListQuizzService;
use App\Http\Requests\Teacher\Quizz\StoreQuizzRequest;
use App\Http\Requests\Teacher\Quizz\ListQuizzRequest;
use App\Http\Requests\Teacher\Quizz\ShowQuizzRequest;
use App\Http\Requests\Teacher\Quizz\SubmitQuizzRequest;
use App\Http\Requests\Teacher\Quizz\UpdateQuizzRequest;
use App\Services\Quizz\ShowQuizzService;
use App\Services\Quizz\SubmitQuizzService;
use App\Services\Quizz\UpdateQuizzService;

class QuizzController extends Controller
{
    public function index(ListQuizzRequest $request, ListQuizzService $service)
    {
        return response()->success(new QuizzCollection($service->setRequest($request)->handle()));
    }

    public function store(StoreQuizzRequest $request, StoreQuizzService $service)
    {
        return response()->success(new QuizzResource($service->setRequest($request)->handle()));
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

    public function update(
        UpdateQuizzRequest $request,
        UpdateQuizzService $updateService,
        ShowQuizzService $showService,
        int $id
    ) {
        $item = $showService->setRequest($request)
            ->setModel($id)
            ->handle();

        $item = $updateService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new QuizzResource($item));
    }
}
