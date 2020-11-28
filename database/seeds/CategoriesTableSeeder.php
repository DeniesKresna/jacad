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

    public function run()
    {      
        $seeds= [
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

        foreach ($seeds as $key => $seed) {
            Category::create($seed);
        }
    }
}
