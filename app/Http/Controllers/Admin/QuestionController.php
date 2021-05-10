<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\StoreQuestionRequest;
use App\Http\Requests\Admin\Question\UpdateQuestionRequest;
use App\Http\Requests\Admin\Question\DeleteQuestionRequest;
use App\Services\Question\StoreQuestionService;
use App\Services\Question\FindQuestionService;
use App\Services\Question\UpdateQuestionService;
use App\Services\Question\DeleteQuestionService;
use App\Http\Resources\Question\QuestionResource;

class QuestionController extends Controller
{
    public function store(StoreQuestionRequest $request, StoreQuestionService $service)
    {
        return response()->success(new QuestionResource($service->setRequest($request)->handle()));
    }

    public function update(
        UpdateQuestionRequest $request,
        FindQuestionService $findService,
        UpdateQuestionService $updateService,
        int $id
    ) {
        $item = $findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function destroy(
        DeleteQuestionRequest $request,
        FindQuestionService $findService,
        DeleteQuestionService $deleteService,
        int $id
    ) {
        $item = $findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $deleteService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
