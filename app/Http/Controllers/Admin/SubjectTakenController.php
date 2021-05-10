<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubjectTaken\UpdateStudentSubjectTakenRequest;
use App\Services\Student\FindStudentService;
use App\Services\SubjectTaken\UpdateStudentSubjectTakenService;

class SubjectTakenController extends Controller
{
    public function update(
        UpdateStudentSubjectTakenService $service,
        UpdateStudentSubjectTakenRequest $request,
        FindStudentService $findStudentService,
        int $id
    ) {
        $student = $findStudentService->setRequest($request)->setModel($id)->handle();

        $service->setRequest($request)->setModel($student)->handle();

        return response()->successWithoutData();
    }
}
