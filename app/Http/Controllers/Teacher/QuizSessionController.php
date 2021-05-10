<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\QuizSession\ListQuizSessionRequest;
use App\Http\Requests\Teacher\QuizSession\FindQuizSessionRequest;
use App\Services\QuizSesstion\ListQuizSessionService;
use App\Services\QuizSesstion\FindQuizSessionService;
use App\Http\Resources\QuizSession\QuizSessionCollection;
use App\Http\Resources\QuizSession\QuizSessionResource;
use App\Http\Requests\Teacher\QuizSession\ExamineQuizSessionRequest;
use App\Services\QuizSesstion\ExamineQuizSessionService;

class QuizSessionController extends Controller
{
    public function index(ListQuizSessionRequest $request, ListQuizSessionService $service)
    {
        return response()->success(new QuizSessionCollection($service->setRequest($request)->handle()));
    }

    public function show(
        FindQuizSessionRequest $request,
        FindQuizSessionService $service,
        int $id
    ) {
        $quizSession = $service->setRequest($request)->setModel($id)->handle();

        return response()
            ->success(new QuizSessionResource($quizSession->load(
                ['mcqQuestions.question.answers', 'blankQuestions.question.answers']
            )));
    }

    public function examineQuizSession(
        ExamineQuizSessionRequest $request,
        FindQuizSessionService $findService,
        ExamineQuizSessionService $examineService,
        int $id
    ) {
        $item = $findService->setRequest($request)
            ->setModel($id)
            ->handle();

        $result = $examineService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success($result);
    }
}
