<?php

namespace App\Notifications\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Notification as ModelsNotification;
use App\Notifications\Admin\AdminGlobalNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovedAppointmentNotification extends AdminGlobalNotification implements ShouldQueue
{
    use Queueable;

    public $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
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
            'code' => ModelsNotification::APPOINTMENT_APPROVED,
            'appointment_id' => $this->appointment->id
        ];
    }
}
