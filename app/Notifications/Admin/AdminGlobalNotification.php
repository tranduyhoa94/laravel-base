<?php

namespace App\Notifications\Admin;

use Illuminate\Broadcasting\Channel;
use Illuminate\Notifications\Notification;

class AdminGlobalNotification extends Notification
{
    public function broadcastOn()
    {
        return [new Channel('admin.global')];
    }
}
