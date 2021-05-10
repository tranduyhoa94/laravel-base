<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Appointment\ListAppointmentRequest;
use App\Services\Appointment\ListAppointmentServices;
use App\Http\Resources\Appointment\AppointmentCollection;

class AppointmentController extends Controller
{
    /**
     * @var ListAppointmentServices
     */
    protected $listService;

    public function __construct(
        ListAppointmentServices $listService
    ) {
        $this->listService = $listService;
    }

    public function index(ListAppointmentRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new AppointmentCollection($items));
    }
}
