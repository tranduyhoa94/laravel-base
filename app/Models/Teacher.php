<?php

namespace App\Models;

use App\Models\Traits\HasJwtToken;
use App\Models\Traits\HasPassword;
use App\Models\Traits\HasRole;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Teacher extends Model implements JWTSubject, AuthenticatableContract
{
    use Authenticatable,
        HasPassword,
        HasRole,
        HasJwtToken;

    use SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'phone', 'gender', 'is_active', 'address'];

    protected $hidden = ['password'];

    public function quizzes()
    {
        return $this->morphMany(Quizz::class, 'createdable');
    }
}
