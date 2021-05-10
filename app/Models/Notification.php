<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * Schedule
     */
    const SCHEDULE_CREATED = 'schedule_created';
    const SCHEDULE_UPDATE = 'schedule_update';

    /**
     * Appointment
     */
    const APPOINTMENT_CREATED = 'appoinement_created';
    const APPOINTMENT_APPROVED = 'appoinement_approved';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notifiable_id',
        'notifiable_type',
        'type',
        'data',
        'read_at'
    ];

    protected $casts = [
        'id'   => 'string',
        'data' => 'object'
    ];

    protected $dates = [
        'read_at'
    ];
}
