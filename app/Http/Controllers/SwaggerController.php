<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mi\L5Swagger\Generator;

class SwaggerController extends Controller
{
    public function index(Generator $generator, $site)
    {
        return response()->success($generator->handle('api/' . $site));
    }
}
