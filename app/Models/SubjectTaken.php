<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTaken extends Model
{
    protected $table = 'subjects_taken';
    
    protected $fillable = [
        'subject_id',
        'student_id'
    ];

    public $timestamps = false;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
