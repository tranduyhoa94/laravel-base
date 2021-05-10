<?php

namespace App\Listeners\Appointment;

use App\Events\Appointment\CreateAppointmentEvent;
use App\Models\Admin;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\Appointment\CreateAppointmentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAppointmentListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(CreateAppointmentEvent $event)
    {
        $appointment  = $event->appointment;

        Notification::send(Admin::first(), new CreateAppointmentNotification($appointment));
    }
}
