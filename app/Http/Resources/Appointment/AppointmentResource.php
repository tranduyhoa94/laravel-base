<?php

namespace App\Http\Resources\Appointment;

use App\Http\Resources\Teacher\TeacherResource;
use App\Http\Resources\Topic\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Slot\SlotAppointmentCollection;

class AppointmentResource extends JsonResource
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
            'email',
            'address',
            'phone',
            'topic_id',
            'teacher_id',
            'verified_at',
            'status',
            'student_id',
            'created_at',
            'comments',
            'at_center'
        ]);

        if ($this->resource->relationLoaded('slots')) {
            $result['slots'] = new SlotAppointmentCollection($this->whenLoaded('slots'));
        }

        $result['topic'] = new TopicResource($this->whenLoaded('topic'));
        $result['teacher'] = new TeacherResource($this->whenLoaded('teacher'));

        return $result;
    }
}
