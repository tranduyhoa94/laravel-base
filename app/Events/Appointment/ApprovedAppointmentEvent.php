<?php

namespace App\Events\Appointment;

use Illuminate\Queue\SerializesModels;

class ApprovedAppointmentEvent
{
    use SerializesModels;

    public $devices;

    public $appointment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($devices, $appointment)
    {
        $this->devices = $devices;
        $this->appointment = $appointment;
    }
}
