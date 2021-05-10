<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Calendar\ListCalendarRequest;
use App\Http\Resources\Slot\SlotCollection;
use App\Services\Slot\ListSlotsService;

class CalendarController extends Controller
{
    public function index(ListSlotsService $service, ListCalendarRequest $request)
    {
        return response()->success(new SlotCollection($service->setRequest($request)->handle()));
    }
}
