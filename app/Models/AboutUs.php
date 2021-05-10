<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public $table = 'master_data';

    protected $fillable = [
        'title',
        'description',
        'facebook_path',
        'instagram_path',
        'youtube_path',
        'twitter_path',
        'email_us',
        'phone_us',
        'address_us'
    ];

    public $timestamps = false;
}
