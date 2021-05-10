<?php

namespace App\Http\Controllers\Student;

use App\Http\Resources\Schedule\ScheduleCollection;
use App\Services\Schedule\ListScheduleService;
use App\Http\Requests\Student\Schedule\ListScheduleRequest;
use App\Http\Controllers\Controller;

class SchedulesController extends Controller
{
    /**
     * @var ListScheduleService
     */
    protected $listService;

    public function __construct(
        ListScheduleService $listService
    ) {
        $this->listService = $listService;
    }

    public function index(ListScheduleRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new ScheduleCollection($items));
    }
}
