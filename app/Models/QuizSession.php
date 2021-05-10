<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QuizSessionQuestion;

class QuizSession extends Model
{
    const TYPE_MCQ = 'mcq';
    const TYPE_BLANK = 'blank';
    const IS_COMPLETED = 1;

    protected $fillable = ['quizz_id', 'type', 'student_id', 'start_time', 'end_time', 'submited_at',
        'teacher_id', 'is_completed', 'scope', 'name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time',
        'submited_at'
    ];

    public function sessionQuestions()
    {
        return $this->hasMany(QuizSessionQuestion::class);
    }

    public function mcqQuestions()
    {
        return $this->hasMany(QuizSessionQuestion::class)->where('type', self::TYPE_MCQ);
    }

    public function blankQuestions()
    {
        return $this->hasMany(QuizSessionQuestion::class)->where('type', self::TYPE_BLANK);
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quizz', 'quizz_id', 'id');
    }

    public static function types():array
    {
        return [
            self::TYPE_MCQ,
            self::TYPE_BLANK
        ];
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }

    public function isCompleted():bool
    {
        return $this->is_completed;
    }

    public function isMCQ():bool
    {
        return $this->type === self::TYPE_MCQ;
    }

    public function isSubmited(): bool
    {
        return !is_null($this->submited_at);
    }
}
