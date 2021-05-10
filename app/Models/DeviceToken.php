<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    public $timestamps = false;

    const PLATFORM_ANDROI = 'android';

    const PLATFORM_IOS = 'ios';

    protected $table = 'device_tokens';

    protected $fillable = ['user_id', 'platform', 'device_id', 'device_token'];

    public static function platForms():array
    {
        return [
            self::PLATFORM_ANDROI,
            self::PLATFORM_IOS
        ];
    }
}
