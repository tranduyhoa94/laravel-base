<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\CreateImageRequest;
use App\Services\Image\CreateImageService;
use App\Http\Resources\Image\ImageResource;

class ImageController extends Controller
{
    public function store(
        CreateImageRequest $request,
        CreateImageService $service
    ) {
        return response()->success(new ImageResource($service->setRequest($request)->handle()));
    }
}
