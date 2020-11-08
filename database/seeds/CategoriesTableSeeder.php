<?php

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
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
                'name' => 'Jobhun Internship',
                'menu' => 'Program' 
            ],

            [ 
                'name' => 'Jobhun Talks' ,
                'menu' => 'Program'
            ],

            [ 
                'name' => 'Jobhun Visit',
                'menu' => 'Program'
            ],

            [ 
                'name' => 'Cerita Karier',
                'menu' => 'Blog' 
            ],

            [ 
                'name' => 'infografik',
                'menu' => 'Blog'
            ],

            [ 
                'name' => 'Karierpedia',
                'menu' => 'Blog'
            ],

            [ 
                'name' => 'Artikel',
                'menu' => 'Blog'
            ],

            [ 
                'name' => 'Berita',
                'menu' => 'Blog'
            ],

            [ 
                'name' => 'Info Acara',
                'menu' => 'Blog'
            ]
        ];
    }

    public function run()
    {   
        foreach ($this->seeds as $key => $seed) {
            Category::create($seed);
        }
    }
}
