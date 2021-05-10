<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Quizz\ListQuizRequest;
use App\Http\Requests\Student\Quizz\CreateQuizSessionRequest;
use App\Services\Quizz\ListQuizzService;
use App\Services\QuizSesstion\CreateQuizSessionService;
use App\Http\Resources\Quizz\QuizzCollection;
use App\Http\Resources\QuizSession\QuizSessionCollection;

class QuizzController extends Controller
{
    public function index(ListQuizRequest $request, ListQuizzService $service)
    {
        return response()->success(new QuizzCollection($service->setRequest($request)->handle()));
    }

    public function quizTest(CreateQuizSessionRequest $request, CreateQuizSessionService $service)
    {
        return response()->success(new QuizSessionCollection($service->setRequest($request)->handle()));
    }
}
