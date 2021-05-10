<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuizSession\ListQuizSessionRequest;
use App\Http\Requests\Admin\QuizSession\AssignTeacherRequest;
use App\Http\Requests\Admin\QuizSession\FindQuizSessionRequest;
use App\Services\QuizSesstion\ListQuizSessionService;
use App\Services\QuizSesstion\FindQuizSessionService;
use App\Services\QuizSesstion\AssignTeacherQuizSessionService;
use App\Http\Resources\QuizSession\QuizSessionCollection;
use App\Http\Resources\QuizSession\QuizSessionResource;

class QuizSessionController extends Controller
{
    public function index(ListQuizSessionRequest $request, ListQuizSessionService $service)
    {
        return response()->success(new QuizSessionCollection($service->setRequest($request)->handle()));
    }

    public function assignTeacher(
        AssignTeacherRequest $request,
        FindQuizSessionService $findService,
        AssignTeacherQuizSessionService $assignService,
        int $id
    ) {
        $item = $findService->setRequest($request)
            ->setModel($id)
            ->handle();

        $assignService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function show(
        FindQuizSessionRequest $request,
        FindQuizSessionService $findService,
        int $id
    ) {
        $quizSession = $findService->setRequest($request)->setModel($id)->handle();

        return response()
            ->success(new QuizSessionResource($quizSession->load(
                ['mcqQuestions.question.answers', 'blankQuestions.question.answers']
            )));
    }
}
