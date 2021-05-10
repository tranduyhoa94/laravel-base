<?php

namespace App\Http\Controllers;

use App\Http\Requests\Me\LogoutRequest;
use App\Http\Requests\Me\UpdateProfileAdminRequest;
use App\Services\Me\LogoutService;
use App\Services\MeService;
use App\Http\Requests\Me\UpdateProfileRequest;
use App\Http\Requests\Me\UpdateProfilePasswordRequest;
use App\Services\Me\UpdateProfileService;
use App\Services\Me\UpdateProfilePasswordService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeController extends Controller
{
    public function me(MeService $service)
    {
        return response()->success(['data' => $service->handle()]);
    }

    public function updateProfile(UpdateProfileRequest $request, UpdateProfileService $service)
    {
        $service->setRequest($request)->setModel($this->getUserClass())->handle();

        return response()->successWithoutData();
    }

    public function updatePassword(UpdateProfilePasswordRequest $request, UpdateProfilePasswordService $service)
    {
        $service->setRequest($request)->setModel($this->getUserClass())->handle();

        return response()->successWithoutData();
    }

    public function updateProfileAdmin(UpdateProfileAdminRequest $request, UpdateProfileService $service)
    {
        $service->setRequest($request)->setModel($this->getUserClass())->handle();

        return response()->successWithoutData();
    }

    public function logout(LogoutRequest $request, LogoutService $service)
    {
        $service->setRequest($request)->handle();

        return response()->successWithoutData();
    }

    private function getUserClass()
    {
        $user = Auth::user();

        $class = Str::studly(Str::camel(class_basename($user)));

        return 'App\\Models\\' . $class;
    }
}
