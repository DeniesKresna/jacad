<?php

use Illuminate\Database\Seeder;

use App\Models\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds= [
            
        ];

        foreach ($seeds as $key => $seed) {
            Job::create($seed);
        }
    }
}
