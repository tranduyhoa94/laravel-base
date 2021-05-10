<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $primaryKey = 'token';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'token',
        'created_at'
    ];

    protected $dates = [
        'created_at'
    ];

    public function roleable()
    {
        return $this->morphTo('roleable', 'roleable_type', 'roleable_email', 'email');
    }
}
