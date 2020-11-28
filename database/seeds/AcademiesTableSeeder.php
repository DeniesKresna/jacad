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
                'description' => 'Ini Content Writer',
                'price' => 700000,
                'category' => 'Jobhun Academy Online Learning',
                'url' => 'http://localhost/magang/jacad/public/academies/content-writer',
                'url_name' => 'content-writer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],

            [
                'name' => 'Copy Writer',
                'description' => 'Ini Copy Writer',
                'price' => 700000,
                'category' => 'Jobhun Academy Online Learning',
                'url' => 'http://localhost/magang/jacad/public/academies/copy-writer',
                'url_name' => 'copy-writer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],

            [
                'name' => 'Social Media Specialist',
                'description' => 'Ini Social Media Specialist',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'url' => 'http://localhost/magang/jacad/public/academies/social-media-specialist',
                'url_name' => 'social-media-specialist',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],

            [
                'name' => 'Digital Marketer',
                'description' => 'Ini Digital Marker',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'url' => 'http://localhost/magang/jacad/public/academies/digital-marketer',
                'url_name' => 'digital-marketer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],

            [
                'name' => 'Web App Development',
                'description' => 'Ini Web App Development',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'url' => 'http://localhost/magang/jacad/public/academies/web-app-development',
                'url_name' => 'web-app-development',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],
            
            [
                'name' => 'Graphic Designer',
                'description' => 'Ini Graphic Designer',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'url' => 'http://localhost/magang/jacad/public/academies/graphic-designer',
                'url_name' => 'graphic-designer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Academy::create($seed);
        }
    }
}
