<?php

namespace App\Http\Resources\Schedule;

use App\Http\Resources\Topic\TopicResource;
use App\Http\Resources\Room\RoomResource;
use App\Http\Resources\Teacher\TeacherResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
        $result =  $this->resource->only([
            'id',
            'topic_id',
            'room_id',
            'name',
            'teacher_id',
            'is_active',
            'start_time',
            'end_time',
        ]);

        $result['topic'] = new TopicResource($this->whenLoaded('topic'));
        $result['room'] = new RoomResource($this->whenLoaded('room'));
        $result['teacher'] = new TeacherResource($this->whenLoaded('teacher'));

        return $result;
    }
}
