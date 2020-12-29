<?php

use Illuminate\Database\Seeder;

use App\Models\Academy;

class AcademiesTableSeeder extends Seeder
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
                'name' => 'Content Writer',
                'description' => '<p>Ini Content Writer</p>',
                'category' => 'Jobhun Academy Online Learning',
                'url' => config('app.url').'/academies/content-writer',
                'url_name' => 'content-writer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'creator_id' => 1,
            ],

            [
                'name' => 'Copy Writer',
                'description' => '<p>Ini Copy Writer</p>',
                'category' => 'Jobhun Academy Online Learning',
                'url' => config('app.url').'/academies/copy-writer',
                'url_name' => 'copy-writer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'creator_id' => 1,
            ],

            [
                'name' => 'Social Media Specialist',
                'description' => '<p>Ini Social Media Specialist</p>',
                'category' => 'Jobhun Academy Online Learning',
                'url' => config('app.url').'/academies/social-media-specialist',
                'url_name' => 'social-media-specialist',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'creator_id' => 1,
            ],

            [
                'name' => 'Digital Marketer',
                'description' => '<p>Ini Digital Marker</p>',
                'category' => 'Jobhun Academy Online Learning',
                'url' => config('app.url').'/academies/digital-marketer',
                'url_name' => 'digital-marketer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'creator_id' => 1,
            ],

            [
                'name' => 'Web App Development',
                'description' => '<p>Ini Web App Development</p>',
                'category' => 'Jobhun Academy Online Learning',
                'url' => config('app.url').'/academies/web-app-development',
                'url_name' => 'web-app-development',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'creator_id' => 1,
            ],
            
            [
                'name' => 'Graphic Designer',
                'description' => '<p>Ini Graphic Designer</p>',
                'category' => 'Jobhun Academy Online Learning',
                'url' => config('app.url').'/academies/graphic-designer',
                'url_name' => 'graphic-designer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'creator_id' => 1,
            ]
        ];
        
        $tags= [
            [1, 2, 3],
            [1, 2],
            [3, 1], 
            [2, 1, 2],
            [3, 2],
            [2, 1]
        ];
        
        foreach ($seeds as $key => $seed) {
            $academy= Academy::create($seed);
            $academy->tags()->attach($tags[$key]);
            $academy->save();
        }
    }
}
