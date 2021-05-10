<?php

namespace App\Models;

use App\Models\Traits\HasJwtToken;
use App\Models\Traits\HasRole;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\SubjectTaken;

class Student extends Model implements JWTSubject, AuthenticatableContract
{
    use Authenticatable,
        HasJwtToken,
        Notifiable,
        HasRole;

    use SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'phone', 'gender', 'address', 'is_active'];
    protected $appends = ['limit_count'];

    protected $hidden = ['password'];

    public function getLimitCountAttribute()
    {
        return $this->hasMany('\App\Models\LimitTest', 'student_id', 'id')->sum('times');
    }

    public function subjectsTaken()
    {
        return $this->hasMany(SubjectTaken::class);
    }
}
