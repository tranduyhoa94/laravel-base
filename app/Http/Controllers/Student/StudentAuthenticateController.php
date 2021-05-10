<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\StudentLoginService;

class StudentAuthenticateController extends Controller
{
    protected $studentLoginService;

    public function __construct(StudentLoginService $studentLoginService)
    {
        $this->studentLoginService = $studentLoginService;
    }

    public function login(AuthenticateRequest $request)
    {
        $token = $this->studentLoginService->setRequest($request)->handle();

        return response()->success($token);
    }
}
