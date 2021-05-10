<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\SubjectTaken\ListSubjectTakenRequest;
use App\Http\Resources\Subject\SubjectCollection;
use App\Services\SubjectTaken\ListSubjectTakenService;

class SubjectTakenController extends Controller
{
    public function index(ListSubjectTakenService $service, ListSubjectTakenRequest $request)
    {
        $items = $service->setRequest($request)->handle();

        return response()->success(new SubjectCollection($items));
    }
}
