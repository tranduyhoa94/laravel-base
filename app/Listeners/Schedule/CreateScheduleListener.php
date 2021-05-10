<?php

namespace App\Listeners\Schedule;

use App\Events\Schedule\CreateScheduleEvent;
use App\Jobs\PushNotificationJob;
use App\Models\Student;
use App\Notifications\Student\Schedule\CreateScheduleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Models\Notification as ModelsNotification;

class CreateScheduleListener implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(CreateScheduleEvent $event)
    {
        $devices = $event->devices;

        # Send notification to student (web)
        Notification::send(Student::first(), new CreateScheduleNotification());

        # Send notification to student (mobile app)
        PushNotificationJob::dispatch(
            $devices,
            [
                'code' => ModelsNotification::SCHEDULE_CREATED,
                'title' => __('messages.notification.schedule_title'),
                'body' => __('messages.notification.schedule_created'),
            ]
        );
    }
}
