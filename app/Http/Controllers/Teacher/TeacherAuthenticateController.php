<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\TeacherLoginService;

class TeacherAuthenticateController extends Controller
{
    protected $teacherLoginService;

    public function __construct(TeacherLoginService $teacherLoginService)
    {
        $this->teacherLoginService = $teacherLoginService;
    }

    public function login(AuthenticateRequest $request)
    {
        $token = $this->teacherLoginService->setRequest($request)->handle();

        return response()->success($token);
    }
}
