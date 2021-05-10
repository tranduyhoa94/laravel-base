<?php

namespace App\Notifications\Student;

use Illuminate\Broadcasting\Channel;
use Illuminate\Notifications\Notification;

class StudentGlobalNotification extends Notification
{
    public function broadcastOn()
    {
        return [new Channel('student.global')];
    }
}
