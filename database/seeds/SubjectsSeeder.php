<?php

use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

class SubjectsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $subjects = require base_path('/database/dumps/subjects_topics.php');
        $now = today();
        DB::transaction(function() use ($subjects, $faker, $now) {
            Schema::disableForeignKeyConstraints();
            Subject::truncate();
            Topic::truncate();
            Schedule::truncate();
            Schema::enableForeignKeyConstraints();
            foreach ($subjects as $subject) {
                $colors = $this->colors();
                $randIndex = array_rand($colors);

                $data = [
                    'name' => $subject['name'],
                    'code' => $subject['code'],
                    'created_by' => $faker->name,
                    'created_at' => $now,
                    'updated_at' => $now,
                    'color' => $colors[$randIndex]
                ];

                $su = Subject::create($data);
                if (!empty($subject['topics'])) {
                    $topics = $this->transformTopics($su->id, $subject['topics'], $now);

                    Topic::insert($topics);
                }
            }
        });
    }

    private function transformTopics(int $id, array $topics,Carbon $now)
    {
        return array_map(function($topic) use ($id, $now) {
            return [
                'name' => $topic,
                'subject_id' => $id,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }, $topics);
    }

    private function colors():array
    {
        return [
            '#D85134',
            '#ED3B14',
            '#ED8714',
            '#E6ED14',
            '#8EED14',
            '#14ED32',
            '#14ED91',
            '#14EDDD',
            '#1498ED',
            '#1445ED',
            '#4C14ED',
            '#AB14ED',
            '#ED14E0',
            '#ED143F',
        ];
    }
}
