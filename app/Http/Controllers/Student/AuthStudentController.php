<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\Student\Account\RegisterStudentRequest;
use App\Http\Resources\Student\StudentResource;
use App\Services\Account\Student\RegisterStudentService;
use App\Http\Controllers\Controller;

class AuthStudentController extends Controller
{
    /**
     * @var RegisterStudentService
     */
    protected $createService;

    public function __construct(
        RegisterStudentService $createService
    ) {
        $this->createService = $createService;
    }

    public function registerStudent(RegisterStudentRequest $request)
    {
        $this->createService
            ->setRequest($request)
            ->handle();

        return response()->successWithoutData();
    }
}
