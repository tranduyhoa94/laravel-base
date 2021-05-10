<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\ListAppointmentRequest;
use App\Services\Appointment\ListAppointmentServices;
use App\Services\Appointment\StoreStudentAppointmentServices;
use App\Http\Resources\Appointment\AppointmentCollection;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Services\Appointment\ApprovedAppointmentServices;
use App\Services\Appointment\DeniedAppointmentServices;
use App\Services\Appointment\FindAppointmentServices;
use App\Http\Requests\Admin\Appointment\UpdateApprovedAppointmentRequest;
use App\Http\Requests\Admin\Appointment\DeniedAppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * @var ListAppointmentServices
     */
    protected $listService;

    /**
     * @var StoreStudentAppointmentServices
     */
    protected $storeStudentService;

    /**
     * @var ApprovedAppointmentServices
     */
    protected $approvedAppointmentService;

    /**
     * @var FindAppointmentServices
     */
    protected $findService;

    /**
     * @var DeniedAppointmentServices
     */
    protected $deniedAppointmentService;

    public function __construct(
        ListAppointmentServices $listService,
        StoreStudentAppointmentServices $storeStudentService,
        ApprovedAppointmentServices $approvedAppointmentService,
        FindAppointmentServices $findService,
        DeniedAppointmentServices $deniedAppointmentService
    ) {
        $this->listService = $listService;
        $this->storeStudentService = $storeStudentService;
        $this->approvedAppointmentService = $approvedAppointmentService;
        $this->findService = $findService;
        $this->deniedAppointmentService = $deniedAppointmentService;
    }

    public function index(ListAppointmentRequest $request)
    {
        $items = $this->listService
            ->setRequest($request)
            ->handle();

        return response()->success(new AppointmentCollection($items));
    }

    public function createAccoutnStudent($id_appointment)
    {
        $this->storeStudentService
            ->setData($id_appointment)
            ->handle();

        return response()->successWithoutData();
    }

    public function updateApprovedAppointment(UpdateApprovedAppointmentRequest $request, $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->approvedAppointmentService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }

    public function updateDeniedAppointment(DeniedAppointmentRequest $request, $id)
    {
        $item = $this->findService
            ->setRequest($request)
            ->setModel($id)
            ->handle();

        $this->deniedAppointmentService
            ->setRequest($request)
            ->setModel($item)
            ->handle();

        return response()->successWithoutData();
    }
}
