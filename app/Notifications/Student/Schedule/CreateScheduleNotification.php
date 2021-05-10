<?php

namespace App\Notifications\Student\Schedule;

use App\Models\Notification as ModelsNotification;
use App\Notifications\Student\StudentGlobalNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateScheduleNotification extends StudentGlobalNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => ModelsNotification::SCHEDULE_CREATED,
        ];
    }
}
