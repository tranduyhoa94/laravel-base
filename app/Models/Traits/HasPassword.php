<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PasswordReset;

trait HasPassword
{
    /**
     * Boot the trait
     *
     * @return void
     */
    public static function bootHasPassword()
    {
        static::creating(function ($model) {
            $model->generatePassword();
        });

        static::updating(function ($model) {
            $model->generatePassword();
        });
    }

    /**
     * Init the password with prefix
     *
     * @param string $prefix
     * @param integer $length
     * @return string
     */
    public static function initPassword($prefix = 'A@a1', $length = 8)
    {
        return $prefix . Str::random($length - strlen($prefix));
    }

    /**
     * Encrypted password
     *
     * @return void
     */
    protected function generatePassword()
    {
        if ($this->isDirty('password')) {
            $this->attributes['password'] = Hash::make($this->attributes['password'] ?? rand());
        }
    }

    public function passwordReset()
    {
        return $this->morphOne(PasswordReset::class, 'roleable', 'roleable_type', 'roleable_email', 'email');
    }
}
