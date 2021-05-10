<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\AboutUs\FindAboutUsRequest;
use App\Http\Resources\AboutUs\AboutUsResource;
use App\Services\AboutUs\FindAboutUsServices;

class AboutUsController extends Controller
{
    public function index(FindAboutUsRequest $request, FindAboutUsServices $service)
    {
        return response()->success(new AboutUsResource($service->setRequest($request)->handle()));
    }
}
