<?php

namespace App\Events\Schedule;

use Illuminate\Queue\SerializesModels;

class CreateScheduleEvent
{
    use SerializesModels;
    
    public $devices;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($devices)
    {
        $this->devices = $devices;
    }
}
