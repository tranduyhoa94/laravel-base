<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    const STATUS_WAITING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DENIED = 2;
    const STRING_WAITING = 'waiting';
    const STRING_DENIED = 'denied';
    const STRING_APPROVED = 'approved';

    protected $fillable = ['name', 'email', 'phone', 'address', 'topic_id',
        'teacher_id', 'verified_at', 'student_id', 'status', 'comments', 'at_center'];

    public function slots()
    {
        return $this->hasMany('App\Models\Slot', 'appointment_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function getStatusAttribute()
    {
        if (!isset($this->attributes['status'])) {
            return null;
        }
        if ($this->attributes['status'] === self::STATUS_WAITING) {
            return 'waiting';
        }
        if ($this->attributes['status'] === self::STATUS_DENIED) {
            return 'denied';
        }
        if ($this->attributes['status'] === self::STATUS_APPROVED) {
            return 'approved';
        }
    }
}
