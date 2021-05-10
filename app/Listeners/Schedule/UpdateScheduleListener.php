<?php

namespace App\Listeners\Schedule;

use App\Events\Schedule\UpdateScheduleEvent;
use App\Jobs\PushNotificationJob;
use App\Models\Notification as ModelsNotification;
use App\Models\Student;
use App\Notifications\Student\Schedule\CreateScheduleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class UpdateScheduleListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(UpdateScheduleEvent $event)
    {
        $devices = $event->devices;

        # Send notification to student (web)
        Notification::send(Student::first(), new CreateScheduleNotification());

        # Send notification to student (mobile app)
        if (count($devices)) {
            PushNotificationJob::dispatch(
                $devices,
                [
                    'code' => ModelsNotification::SCHEDULE_UPDATE,
                    'title' => __('messages.notification.schedule_title'),
                    'body' => __('messages.notification.schedule_updated'),
                ]
            );
        }
    }
}
