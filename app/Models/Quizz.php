<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quizz extends Model
{
    use SoftDeletes;

    protected $table = 'quizzes';

    protected $fillable = [
        'name',
        'topic_id',
        'range_time',
        'status',
        'type',
        'createdable_id',
        'createdable_type',
        'number_questions'
    ];

    protected $casts = [
        'topic_id' => 'integer',
        'range_time' => 'integer',
        'is_submited' => 'boolean',
        'is_approved' => 'boolean',
    ];

    const RANGE_TIME_MIN = 30;
    const RANGE_TIME_MAX = 90;

    const STATUS_PENDING = 'pending';
    const STATUS_SUBMITED = 'submited';
    const STATUS_PREAPROVE = 'preapprove';
    const STATUS_APPROVED = 'approved';

    const TYPE_MCQ = 'mcq';
    const TYPE_BLANK = 'blank';
    const TYPE_BOTH = 'both';

    const MIN_NUMBER_QUESTION = 1;
    const MAX_NUMBER_QUESTION = 100;

    public static function types():array
    {
        return [
            self::TYPE_MCQ,
            self::TYPE_BLANK,
            self::TYPE_BOTH
        ];
    }

    public function createdable()
    {
        return $this->morphTo();
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'quizz_id', 'id');
    }

    public function mCQuestions()
    {
        return $this->hasMany(Question::class)
            ->whereIn('type', [Question::TYPE_MULTIPLE, Question::TYPE_SINGLE]);
    }

    public function blankQuestions()
    {
        return $this->hasMany(Question::class)
            ->where('type', Question::TYPE_BLANK);
    }

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }

    /**
     * ==================
     * = Attributes
     * ==================
     */

    public function getHasMCQAttribute()
    {
        return $this->hasMany(Question::class)
            ->whereIn('type', [Question::TYPE_MULTIPLE, Question::TYPE_SINGLE])
            ->exists();
    }

    public function getHasBlankAttribute()
    {
        return $this->hasMany(Question::class)
            ->where('type', Question::TYPE_BLANK)
            ->exists();
    }

    public function isPending():bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isSubmited():bool
    {
        return $this->status === self::STATUS_SUBMITED;
    }

    public function isPreapprove():bool
    {
        return $this->status === self::STATUS_PREAPROVE;
    }

    public function isApproved():bool
    {
        return $this->status === self::STATUS_APPROVED;
    }
}
