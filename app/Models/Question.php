<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    const TYPE_SINGLE = 'single_choice';
    const TYPE_MULTIPLE = 'multiple_choice';
    const TYPE_BLANK = 'blank';
    const IS_APPROVED = 1;

    protected $fillable = ['name', 'is_approved', 'type', 'quizz_id', 'note'];
    protected $appends = ['image_url'];

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }

    public function quizz()
    {
        return $this->belongsTo(\App\Models\Quizz::class);
    }

    public function answerShuffle()
    {
        return $this->hasMany(\App\Models\Answer::class, 'question_id', 'id')->inRandomOrder();
    }

    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class, 'question_id', 'id');
    }

    public function isApproved():bool
    {
        return $this->is_approved;
    }

    public static function types():array
    {
        return [
            self::TYPE_SINGLE,
            self::TYPE_MULTIPLE,
            self::TYPE_BLANK
        ];
    }

    public function getImageUrlAttribute()
    {
        return $this->hasOne('\App\Models\Image', 'question_id', 'id')->select(['id', 'path'])->first();
    }
}
