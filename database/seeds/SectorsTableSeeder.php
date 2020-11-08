<?php

use Illuminate\Database\Seeder;

use App\Models\Sector;

class SectorsTableSeeder extends Seeder
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
                'name' => 'Designer',
                'creator_id' => 1
            ],

            [
                'name' => 'Programmer',
                'creator_id' => 1
            ], 

            [
                'name' => 'Marketing',
                'creator_id' => 1
            ],

            [
                'name' => 'Human Resource',
                'creator_id' => 1
            ],

            [
                'name' => 'Accounting',
                'creator_id' => 1
            ]
        ];
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            Sector::create($seed);
        }
    }
}
