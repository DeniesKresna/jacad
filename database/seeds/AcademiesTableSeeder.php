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

    private $seeds;

    public function __construct()
    {
        $this->seeds= [
            [
                'name' => 'Content Writer',
                'desc' => 'Ini Content Writer',
                'price' => 700000,
                'sku' => '9758-1-1-1-1-1-2-1-1-1',
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
                'desc' => 'Ini Copy Writer',
                'price' => 700000,
                'sku' => '9758-1-1-1-1-1-2-1-1-2',
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
                'desc' => 'Ini Social Media Specialist',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'sku' => '9758-1-1-1-1-1-2-1-1-3',
                'url' => 'http://localhost/magang/jacad/public/academies/social-media-specialist',
                'url_name' => 'social-media-specialist',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],

            [
                'name' => 'Digital Marketer',
                'desc' => 'Ini Digital Marker',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'sku' => '9758-1-1-1-1-1-2-1-1-4',
                'url' => 'http://localhost/magang/jacad/public/academies/digital-marketer',
                'url_name' => 'digital-marketer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],

            [
                'name' => 'Web App Development',
                'desc' => 'Ini Web App Development',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'sku' => '9758-1-1-1-1-1-2-1-1-5',
                'url' => 'http://localhost/magang/jacad/public/academies/web-app-development',
                'url_name' => 'web-app-development',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ],
            
            [
                'name' => 'Graphic Designer',
                'desc' => 'Ini Graphic Designer',
                'category' => 'Jobhun Academy Online Learning',
                'price' => 700000,
                'sku' => '9758-1-1-1-1-1-2-1-1-6',
                'url' => 'http://localhost/magang/jacad/public/academies/graphic-designer',
                'url_name' => 'graphic-designer',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/03/WhatsApp-Image-2020-09-08-at-20.21.02-325x380.jpeg',
                'image_path' => '',
                'batch' => 1,
                'creator_id' => 1,
            ]
        ];
    }   
    
    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            Academy::create($seed);
        }
    }
}
