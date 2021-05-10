<?php

namespace App\Listeners\Appointment;

use App\Events\Appointment\ApprovedAppointmentEvent;
use App\Jobs\PushNotificationJob;
use App\Models\Admin;
use App\Models\Notification as ModelsNotification;
use App\Notifications\Admin\Appointment\ApprovedAppointmentNotification;
use Illuminate\Support\Facades\Notification;

class ApprovedAppointmentListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ApprovedAppointmentEvent $event)
    {
        $devices = $event->devices;

        # Send notification to admin (web)
        Notification::send(Admin::first(), new ApprovedAppointmentNotification($event->appointment));

        # Send notification to student (mobile app)
        if (count($devices)) {
            PushNotificationJob::dispatch(
                $devices,
                [
                    'code' => ModelsNotification::APPOINTMENT_APPROVED,
                    'title' => __('messages.notification.appointment_tile'),
                    'body' => __('messages.notification.appointment_approved'),
                ]
            );
        }
    }
}
