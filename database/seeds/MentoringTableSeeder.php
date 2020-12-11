<?php

use Illuminate\Database\Seeder;

use App\Models\Mentoring;

class MentoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds= [
            [
                'spesific_topic' => 'Ini topik 1',
                'date' => '28-11-2020',
                'time' => '2 PM',
                'duration' => '1 jam',
                'jobhun_info' => 'Instagram',
                'ask_career_id' => 1,
                'customer_id' => 1
            ],

            [
                'spesific_topic' => 'Ini topik 2',
                'date' => '28-11-2020',
                'time' => '2 PM',
                'duration' => '1 jam',
                'jobhun_info' => 'Instagram',
                'ask_career_id' => 2,
                'customer_id' => 1
            ],

            [
                'spesific_topic' => 'Ini topik 3',
                'date' => '28-11-2020',
                'time' => '2 PM',
                'duration' => '1 jam',
                'jobhun_info' => 'Instagram',
                'ask_career_id' => 3,
                'customer_id' => 1
            ],

            [
                'spesific_topic' => 'Ini topik 4',
                'date' => '28-11-2020',
                'time' => '2 PM',
                'duration' => '1 jam',
                'jobhun_info' => 'Instagram',
                'ask_career_id' => 4,
                'customer_id' => 1
            ],

            [
                'spesific_topic' => 'Ini topik 5',
                'date' => '28-11-2020',
                'time' => '2 PM',
                'duration' => '1 jam',
                'jobhun_info' => 'Instagram',
                'ask_career_id' => 5,
                'customer_id' => 1
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Mentoring::create($seed);
        }
    }
}
