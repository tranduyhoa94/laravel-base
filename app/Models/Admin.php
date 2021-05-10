<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Traits\HasJwtToken;
use App\Models\Traits\HasPassword;
use App\Models\Traits\HasRole;
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements JWTSubject, AuthenticatableContract
{
    use Authenticatable,
        HasJwtToken,
        HasPassword,
        HasRole,
        SoftDeletes;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_super_admin', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function quizzes()
    {
        return $this->morphMany(Quizz::class, 'createdable');
    }
}
