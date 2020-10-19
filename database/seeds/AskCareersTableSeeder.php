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
    public function run()
    {
        $seeds= [   
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
        
        foreach ($seeds as $key => $seed) {
            AskCareer::create($seed);
        }
    }
}
