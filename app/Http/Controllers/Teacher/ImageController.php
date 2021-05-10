<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests\Admin\Image\CreateImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Services\Image\CreateImageService;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function store(
        CreateImageRequest $request,
        CreateImageService $service
    ) {
        return response()->success(new ImageResource($service->setRequest($request)->handle()));
    }
}
