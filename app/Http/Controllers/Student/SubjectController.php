<?php

namespace App\Http\Controllers\Student;

use App\Http\Resources\Subject\SubjectCollection;
use App\Services\Subject\ListSubjectService;
use App\Http\Requests\Student\Subject\ListSubjectRequest;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * @var ListSubjectService
     */
    protected $listService;

    public function __construct(
        ListSubjectService $listService
    ) {
        $this->listService = $listService;
    }

    public function index(ListSubjectRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new SubjectCollection($items));
    }
}
