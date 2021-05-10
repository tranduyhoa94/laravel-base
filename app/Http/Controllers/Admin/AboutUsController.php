<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUs\FindAboutUsRequest;
use App\Http\Requests\Admin\AboutUs\UpdateAboutUsRequest;
use App\Http\Resources\AboutUs\AboutUsResource;
use App\Services\AboutUs\UpdateAboutUsServices;
use App\Services\AboutUs\FindAboutUsServices;

class AboutUsController extends Controller
{

    /**
     * @var UpdateAboutUsServices
     */
    protected $updateService;

    /**
     * @var FindAboutUsServices
     */
    protected $findService;

    public function __construct(
        UpdateAboutUsServices $updateService,
        FindAboutUsServices $findService
    ) {
        $this->updateService = $updateService;
        $this->findService = $findService;
    }

    public function index(FindAboutUsRequest $request)
    {
        $item = $this->findService
            ->setRequest($request)
            ->handle();

        return response()->success(new AboutUsResource($item));
    }

    public function update(UpdateAboutUsRequest $request)
    {
        $item = $this->findService
            ->setRequest($request)
            ->handle();

        $item = $this->updateService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->success(new AboutUsResource($item));
    }
}
