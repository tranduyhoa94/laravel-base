<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests\Teacher\Question\UpdateQuestionRequest;
use App\Http\Requests\Teacher\Question\StoreQuestionRequest;
use App\Http\Requests\Teacher\Question\DeleteQuestionRequest;
use App\Http\Resources\Question\QuestionResource;
use App\Services\Question\FindQuestionService;
use App\Services\Question\StoreQuestionService;
use App\Http\Controllers\Controller;
use App\Services\Question\UpdateQuestionService;
use App\Services\Question\DeleteQuestionService;

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
