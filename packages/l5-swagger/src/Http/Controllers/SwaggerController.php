<?php

namespace Mi\L5Swagger\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/** @SuppressWarnings(PHPMD.NumberOfChildren) */
class SwaggerController extends BaseController
{
    public function index(string $site)
    {
        return view('l5-swagger::layout', ['site' => $site]);
    }
}
