<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ListCalendarRequest;
use App\Http\Resources\Slot\SlotCollection;
use App\Services\Slot\ListSlotsService;

class CalendarController extends Controller
{
    public function index(ListCalendarRequest $request, ListSlotsService $service)
    {
        return response()->success(new SlotCollection($service->setRequest($request)->handle()));
    }
}
