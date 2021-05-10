<?php

use App\Models\Room;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schedule::truncate();
        $teacherIds = Teacher::pluck('id');
        $roomIds = Room::pluck('id');
        $topicIds = Topic::pluck('id');

        if (empty($teacherIds) || empty($roomIds) || empty($topicIds)) {
            return;
        }

        for($i = 1; $i <=20; $i++) {
            factory(\App\Models\Schedule::class, 10)->create([
                'room_id' => $roomIds[array_rand($roomIds->toArray(), 1)],
                'teacher_id' => $teacherIds[array_rand($teacherIds->toArray(), 1)],
                'topic_id' => $topicIds[array_rand($topicIds->toArray(), 1)]
            ]);
        }
    }
}
