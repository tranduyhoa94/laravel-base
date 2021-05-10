<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\AdminLoginService;

class AuthenticateController extends Controller
{
    protected $adminLoginService;

    public function __construct(AdminLoginService $adminLoginService)
    {
        $this->adminLoginService = $adminLoginService;
    }

    public function login(AuthenticateRequest $request)
    {
        $token = $this->adminLoginService->setRequest($request)->handle();
        
        return response()->success($token);
    }
}
