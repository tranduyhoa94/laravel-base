<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Student\Appointment\ListAppointmentRequest;
use App\Services\Appointment\CreateAppointmentServices;
use App\Services\Appointment\ListAppointmentServices;
use App\Http\Resources\Appointment\AppointmentCollection;

class AppointmentController extends Controller
{
    /**
     * @var ListAppointmentServices
     */
    protected $listService;

    /**
     * @var CreateAppointmentServices
     */
    protected $createService;

    public function __construct(
        CreateAppointmentServices $createService,
        ListAppointmentServices $listService
    ) {
        $this->createService = $createService;
        $this->listService = $listService;
    }

    public function store(StoreAppointmentRequest $request)
    {
        $this->createService
            ->setRequest($request)
            ->handle();

        return response()->successWithoutData();
    }

    public function index(ListAppointmentRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new AppointmentCollection($items));
    }
}
