<?php

use Illuminate\Database\Seeder;

use App\Models\JobSector;

class JobSectorTableSeeder extends Seeder
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
                'job_id' => 1,
                'sector_id' => 1
            ],

            [
                'job_id' => 1,
                'sector_id' => 2
            ],

            [
                'job_id' => 1,
                'sector_id' => 3
            ],

            [
                'job_id' => 2,
                'sector_id' => 4
            ],

            [
                'job_id' => 2,
                'sector_id' => 5
            ],

            [
                'job_id' => 3,
                'sector_id' => 1
            ],

            [
                'job_id' => 3,
                'sector_id' => 2
            ],

            [
                'job_id' => 3,
                'sector_id' => 3
            ],

            [
                'job_id' => 4,
                'sector_id' => 4
            ],

            [
                'job_id' => 4,
                'sector_id' => 5
            ],

            [
                'job_id' => 5,
                'sector_id' => 1
            ],

            [
                'job_id' => 5,
                'sector_id' => 2
            ],

            [
                'job_id' => 5,
                'sector_id' => 3
            ],

            [
                'job_id' => 6,
                'sector_id' => 4
            ],

            [
                'job_id' => 6,
                'sector_id' => 5
            ],

            [
                'job_id' => 7,
                'sector_id' => 1
            ],

            [
                'job_id' => 7,
                'sector_id' => 2
            ],

            [
                'job_id' => 7,
                'sector_id' => 3
            ],

            [
                'job_id' => 8,
                'sector_id' => 4
            ],

            [
                'job_id' => 8,
                'sector_id' => 5
            ],

            [
                'job_id' => 9,
                'sector_id' => 1
            ],

            [
                'job_id' => 9,
                'sector_id' => 2
            ],

            [
                'job_id' => 9,
                'sector_id' => 3
            ]
        ];
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            JobSector::create($seed);
        }
    }
}
