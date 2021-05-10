<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'is_active',
        'code',
        'color'
    ];

    public function topics()
    {
        return $this->hasMany('App\Models\Topic', 'subject_id', 'id');
    }
}
