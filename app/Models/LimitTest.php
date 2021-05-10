<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LimitTest extends Model
{
    protected $fillable = [
        'times',
        'subject_id',
        'student_id',
        'start_time',
        'end_time'
    ];

    protected $dates = [
        'start_time',
        'end_time'
    ];

    public function subjects()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id', 'id');
    }

    public function students()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }
}
