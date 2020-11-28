<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademyTagTableSeeder extends Seeder
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
                'tag_id' => 1,
                'academy_id' => 1
            ],

            [
                'tag_id' => 2,
                'academy_id' => 1
            ],
            
            [
                'tag_id' => 3,
                'academy_id' => 1
            ],
            
            [
                'tag_id' => 1,
                'academy_id' => 2
            ],

            [
                'tag_id' => 2,
                'academy_id' => 2
            ],
            
            [
                'tag_id' => 3,
                'academy_id' => 2
            ],

            [
                'tag_id' => 1,
                'academy_id' => 3
            ],

            [
                'tag_id' => 2,
                'academy_id' => 3
            ],
            
            [
                'tag_id' => 3,
                'academy_id' => 3
            ],

            [
                'tag_id' => 1,
                'academy_id' => 4
            ],

            [
                'tag_id' => 2,
                'academy_id' => 4
            ],
            
            [
                'tag_id' => 3,
                'academy_id' => 4
            ],

            [
                'tag_id' => 1,
                'academy_id' => 5
            ],

            [
                'tag_id' => 2,
                'academy_id' => 5
            ],
            
            [
                'tag_id' => 3,
                'academy_id' => 5
            ],

            [
                'tag_id' => 1,
                'academy_id' => 6
            ],

            [
                'tag_id' => 2,
                'academy_id' => 6
            ],
            
            [
                'tag_id' => 3,
                'academy_id' => 6
            ]
        ];

        foreach ($seeds as $key => $seed) {
            DB::table('academy_tag')->insert($seed);
        }
    }
}
