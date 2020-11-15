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
                'desc' => '',
                'category' => '',
                'price' => 700000,
                'sku' => '',
                'url_title' => '',
                'image_url' => '',
                'image_path' => '',
                'creator_id' => 1,
            ],

            [
                'name' => 'Copy Writer',
                'description' => '',
                'category' => '',
                'price' => 700000,
                'sku' => '',
                'url_title' => '',
                'image_url' => '',
                'image_path' => '',
                'creator_id' => 1,
            ],

            [
                'name' => 'Social Media Specialist',
                'description' => '',
                'category' => '',
                'price' => 700000,
                'sku' => '',
                'url_title' => '',
                'image_url' => '',
                'image_path' => '',
                'creator_id' => 1,
            ],

            [
                'name' => 'Digital Marketer',
                'description' => '',
                'category' => '',
                'price' => 700000,
                'sku' => '',
                'url_title' => '',
                'image_url' => '',
                'image_path' => '',
                'creator_id' => 1,
            ],

            [
                'name' => 'Web App Development',
                'description' => '',
                'category' => '',
                'price' => 700000,
                'sku' => '',
                'url_title' => '',
                'image_url' => '',
                'image_path' => '',
                'creator_id' => 1,
            ],
            
            [
                'name' => 'Graphic Designer',
                'description' => '',
                'category' => '',
                'price' => 700000,
                'sku' => '',
                'url_title' => '',
                'image_url' => '',
                'image_path' => '',
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
