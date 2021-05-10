<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\QuizSession\ShowQuizSessionRequest;
use App\Http\Requests\Student\QuizSession\SubmitQuizSessionRequest;
use App\Http\Requests\Student\QuizSession\ListQuizSessionRequest;
use App\Http\Resources\QuizSession\QuizSessionCollection;
use App\Http\Resources\QuizSession\QuizSessionResource;
use App\Http\Resources\QuizSession\QuizSessionStudentResource;
use App\Services\QuizSesstion\FindQuizSessionService;
use App\Services\QuizSesstion\SubmitQuizSessionService;
use App\Services\QuizSesstion\ListQuizSessionService;
use App\Services\QuizSesstion\ShowQuizSessionService;

class QuizSessionController extends Controller
{
    public function show(FindQuizSessionService $service, ShowQuizSessionRequest $request, int $id)
    {
        $quizSession = $service->setRequest($request)->setModel($id)->handle();

        return response()
            ->success(new QuizSessionResource($quizSession->load(
                ['mcqQuestions.question.answerShuffle', 'blankQuestions.question.answerShuffle']
            )));
    }

    public function submit(
        FindQuizSessionService $service,
        SubmitQuizSessionRequest $request,
        SubmitQuizSessionService $submitService,
        int $id
    ) {
        $item = $service->setRequest($request)
            ->setModel($id)
            ->handle();

        $result = $submitService->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success($result);
    }

    public function index(
        ListQuizSessionRequest $request,
        ListQuizSessionService $service
    ) {
        return response()->success(new QuizSessionCollection($service->setRequest($request)->handle()));
    }

    public function showQuizSession(
        ShowQuizSessionService $service,
        ShowQuizSessionRequest $request,
        int $id
    ) {
        $quizSession = $service->setRequest($request)->setModel($id)->handle();

        return response()
            ->success(new QuizSessionStudentResource($quizSession->load(
                ['mcqQuestions.question.answers', 'blankQuestions.question.answers']
            )));
    }
}
