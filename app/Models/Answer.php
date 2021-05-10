<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;

    protected $fillable = ['content','question_id', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }
}
