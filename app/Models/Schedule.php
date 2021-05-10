<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = ['topic_id', 'room_id', 'teacher_id', 'is_active', 'start_time', 'end_time', 'name'];

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic', 'topic_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room', 'room_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id', 'id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time'
    ];
}
