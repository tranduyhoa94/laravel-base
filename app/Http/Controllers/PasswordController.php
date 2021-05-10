<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\SendMailRequest;
use App\Services\Password\CreateTokenService;
use App\Services\Password\ResetPasswordService;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    protected $createTokenService;
    protected $resetPasswordService;

    public function __construct(
        CreateTokenService $createTokenService,
        ResetPasswordService $resetPasswordService
    ) {
        $this->createTokenService = $createTokenService;
        $this->resetPasswordService = $resetPasswordService;
    }

    public function sendResetLinkEmail(SendMailRequest $request)
    {
        $this->createTokenService->setModel($this->getUserClassFromRoute($request->route()->getName()))
            ->setData($request->validated())
            ->handle();

        return response()->successWithoutData();
    }

    public function reset()
    {
        // TODO: call service reset password
    }

    private function getUserClassFromRoute($routeName)
    {
        preg_match('/^(\w+)\.password/', $routeName, $matches);

        $class = Str::studly($matches[1]);

        return 'App\\Models\\' . $class;
    }
}
