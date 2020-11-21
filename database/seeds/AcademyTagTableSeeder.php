<?php

use Illuminate\Database\Seeder;

use App\Models\AcademyTag;

class AcademyTagTableSeeder extends Seeder
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
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            AcademyTag::create($seed);
        }
    }
}
