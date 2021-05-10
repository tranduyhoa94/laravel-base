<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSessionQuestion extends Model
{
    protected $fillable = ['quiz_session_id', 'question_id', 'choose_answers',
        'content_answers', 'is_correct', 'note'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    protected $casts = [
        'choose_answers' => 'array',
    ];
}
