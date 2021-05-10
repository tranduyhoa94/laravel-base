<?php

namespace App\Events\Appointment;

use App\Models\Appointment;
use Illuminate\Queue\SerializesModels;

class CreateAppointmentEvent
{
    use SerializesModels;

    /**
     * Appointment
     */

    public $appointment;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }
}
