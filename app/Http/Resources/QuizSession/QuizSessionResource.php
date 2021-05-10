<?php

namespace App\Http\Resources\QuizSession;

use App\Http\Resources\QuizSessionQuestion\QuizSessionQuestionCollection;
use App\Http\Resources\Teacher\TeacherResource;
use App\Http\Resources\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use App\Http\Resources\Quizz\QuizzResource;

class QuizSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray($request)
    {
        $result = $this->resource->only([
            'id',
            'name',
            'quizz_id',
            'type',
            'student_id',
            'start_time',
            'end_time',
            'submited_at',
            'teacher_id',
            'is_completed',
            'scope',
        ]);

        $result['range_time'] = Carbon::parse($this->resource->start_time)->diffInMinutes($this->resource->end_time);
        $result['blankQuestions'] = new QuizSessionQuestionCollection($this->whenLoaded('blankQuestions'));
        $result['mcqQuestions'] = new QuizSessionQuestionCollection($this->whenLoaded('mcqQuestions'));
        $result['teacher'] = new TeacherResource($this->whenLoaded('teacher'));
        $result['student'] = new StudentResource($this->whenLoaded('student'));
        $result['quiz'] = new QuizzResource($this->whenLoaded('quiz'));

        return $result;
    }
}
