<?php

use Illuminate\Database\Seeder;

use App\Models\AskCareer;

class AskCareersTableSeeder extends Seeder
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
                'name' => 'A',
                'price' => 700000
            ],

            [
                'name' => 'B',
                'price' => 700000
            ],

            [
                'name' => 'C',
                'price' => 700000
            ],

            [
                'name' => 'D',
                'price' => 700000
            ],
            
            [
                'name' => 'E',
                'price' => 700000
            ],

            [
                'name' => 'F',
                'price' => 700000
            ]
        ];
    }

    public function run()
    {   
        foreach ($this->seeds as $key => $seed) {
            AskCareer::create($seed);
        }
    }
}
