<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Schedule\CreateScheduleEvent' => [
            'App\Listeners\Schedule\CreateScheduleListener',
        ],
        'App\Events\Appointment\CreateAppointmentEvent' => [
            'App\Listeners\Appointment\CreateAppointmentListener',
        ],
        'App\Events\Schedule\UpdateScheduleEvent' => [
            'App\Listeners\Schedule\UpdateScheduleListener',
        ],
        'App\Events\Appointment\ApprovedAppointmentEvent' => [
            'App\Listeners\Appointment\ApprovedAppointmentListener',
        ],
    ];
}
