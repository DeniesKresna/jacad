<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTagTableSeeder extends Seeder
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
                'blog_id' => 1
            ],

            [
                'tag_id' => 2,
                'blog_id' => 1
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 1
            ],
            
            [
                'tag_id' => 1,
                'blog_id' => 2
            ],

            [
                'tag_id' => 2,
                'blog_id' => 2
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 2
            ],

            [
                'tag_id' => 1,
                'blog_id' => 3
            ],

            [
                'tag_id' => 2,
                'blog_id' => 3
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 3
            ],

            [
                'tag_id' => 1,
                'blog_id' => 4
            ],

            [
                'tag_id' => 2,
                'blog_id' => 4
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 4
            ],

            [
                'tag_id' => 1,
                'blog_id' => 5
            ],

            [
                'tag_id' => 2,
                'blog_id' => 5
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 5
            ],

            [
                'tag_id' => 1,
                'blog_id' => 6
            ],

            [
                'tag_id' => 2,
                'blog_id' => 6
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 6
            ],

            [
                'tag_id' => 1,
                'blog_id' => 7
            ],

            [
                'tag_id' => 2,
                'blog_id' => 7
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 7
            ],

            [
                'tag_id' => 1,
                'blog_id' => 8
            ],

            [
                'tag_id' => 2,
                'blog_id' => 8
            ],
            
            [
                'tag_id' => 3,
                'blog_id' => 8
            ]
        ];

        foreach ($seeds as $key => $seed) {
            DB::table('blog_tag')->insert($seed);
        }
    }
}
