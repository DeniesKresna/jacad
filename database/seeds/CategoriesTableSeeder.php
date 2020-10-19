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
            [ 'name' => 'Jobhun Internship' ],
            [ 'name' => 'Jobhun Talks' ],
            [ 'name' => 'Jobhun Visit' ],
            [ 'name' => 'Cerita Karier' ],
            [ 'name' => 'infografik' ],
            [ 'name' => 'Karierpedia' ],
            [ 'name' => 'Artikel' ],
            [ 'name' => 'Berita' ],
            [ 'name' => 'Info Acara' ]
        ];
        
        foreach ($seeds as $key => $seed) {
            Category::create($seed);
        }
    }
}
