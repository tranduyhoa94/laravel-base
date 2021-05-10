<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'subject_id', 'is_active', 'description'];

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Topic', 'topic_id', 'id');
    }
}
