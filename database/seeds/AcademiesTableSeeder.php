<?php

use Illuminate\Database\Seeder;
use App\Models\Academy;

class AcademiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $seeds;

    public function __construct()
    {
        $this->seeds= [
            [
                'name' => 'Content Writer',
                'description' => '',
                'rating' => 4.5,
                'review' => '',
                'price' => 700000,
                'faq' => '',
                'learning_resources' => '',
                'learning_process' => '',
                'starting_time' => '',
                'platform' => '',
                'mentor_id' => 1,
                'creator_id' => 1,
                'updater_id' => 1 
            ],

            [
                'name' => 'Copy Writer',
                'description' => '',
                'rating' => 4.5,
                'review' => '',
                'price' => 700000,
                'faq' => '',
                'learning_resources' => '',
                'learning_process' => '',
                'starting_time' => '',
                'platform' => '',
                'mentor_id' => 2,
                'creator_id' => 1,
                'updater_id' => 1 
            ],

            [
                'name' => 'Social Media Specialist',
                'description' => '',
                'rating' => 4.5,
                'review' => '',
                'price' => 700000,
                'faq' => '',
                'learning_resources' => '',
                'learning_process' => '',
                'starting_time' => '',
                'platform' => '',
                'mentor_id' => 3,
                'creator_id' => 1,
                'updater_id' => 1 
            ],

            [
                'name' => 'Digital Marketer',
                'description' => '',
                'rating' => 4.5,
                'review' => '',
                'price' => 700000,
                'faq' => '',
                'learning_resources' => '',
                'learning_process' => '',
                'starting_time' => '',
                'platform' => '',
                'mentor_id' => 4,
                'creator_id' => 1,
                'updater_id' => 1 
            ],

            [
                'name' => 'Web App Development',
                'description' => '',
                'rating' => 4.5,
                'review' => '',
                'price' => 700000,
                'faq' => '',
                'learning_resources' => '',
                'learning_process' => '',
                'starting_time' => '',
                'platform' => '',
                'mentor_id' => 5,
                'creator_id' => 1,
                'updater_id' => 1 
            ],
            
            [
                'name' => 'Graphic Designer',
                'description' => '',
                'rating' => 4.5,
                'review' => '',
                'price' => 700000,
                'faq' => '',
                'learning_resources' => '',
                'learning_process' => '',
                'starting_time' => '',
                'platform' => '',
                'mentor_id' => 6,
                'creator_id' => 1,
                'updater_id' => 1 
            ]
        ];
    }
    
    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            Academy::create($seed);
        }
    }
}
