<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;

    protected $table = 'images';
    protected $fillable = ['path', 'question_id'];
    /* @array $appends */
    public $appends = ['normal_path', 'medium_path', 'full_path'];

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }

    public function getNormalPathAttribute()
    {
        return $this->getUrl().'images/normal/'.$this->path;
    }

    public function getMediumPathAttribute()
    {
        return $this->getUrl().'images/medium/'.$this->path;
    }

    public function getFullPathAttribute()
    {
        return $this->getUrl().'images/full/'.$this->path;
    }

    public function getUrl()
    {
        return 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    }
}
