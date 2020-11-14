<?php

use Illuminate\Database\Seeder;

use App\Models\BlogTag;

class BlogTagTableSeeder extends Seeder
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
            ],
        ];
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            BlogTag::create($seed);
        }
    }
}
