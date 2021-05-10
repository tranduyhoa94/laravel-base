<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = ['appointment_id', 'start_time', 'end_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time'
    ];

    public function appointment()
    {
        return $this->belongsTo(\App\Models\Appointment::class, 'appointment_id', 'id');
    }
}
