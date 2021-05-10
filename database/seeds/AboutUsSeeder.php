<?php

use App\Models\AboutUs;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        AboutUs::truncate();
        AboutUs::create([
            'title' => $faker->title,
            'description' => 'A Brunei-based tuition centre with a vision to inspire students to work on personal development and self-confidence to believe in themselves.',
            'facebook_path' => 'https://www.facebook.com/MyVerveTC',
            'instagram_path' => 'https://www.instagram.com/myvervetc/',
            'youtube_path' => $faker->url,
            'twitter_path' => $faker->url,
            'email_us' => 'myverve2020@gmail.com',
            'phone_us' => '+673 8356562',
            'address_us' => 'Unit 10 & 11, First Floor, Block A, Muhibbah Complex II, Jalan Gadong, Menglait, BE3919',
        ]);
    }
}
