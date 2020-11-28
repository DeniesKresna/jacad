<?php

use Illuminate\Database\Seeder;

use App\Models\AcademyRegistrant;

class AcademyRegistrantsTableSeeder extends Seeder
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
                'name' => 'Pendaftar 1',
                'email' => 'pendaftar1@mail.com', 
                'phone' => '081234567890',
                'domicile' => 'Surabaya',
                'profession' => 'dummy text',
                'jobhun_info' => 'Instagram',
                'batch' => '1',
                'academy_id' => 1,
                'creator_id' => 1
            ],

            [
                'name' => 'Pendaftar 2',
                'email' => 'pendaftar2@mail.com', 
                'phone' => '081234567890',
                'domicile' => 'Surabaya',
                'profession' => 'dummy text',
                'jobhun_info' => 'Instagram',
                'batch' => '1',
                'academy_id' => 2,
                'creator_id' => 1
            ],

            [
                'name' => 'Pendaftar 3',
                'email' => 'pendaftar3@mail.com', 
                'phone' => '081234567890',
                'domicile' => 'Surabaya',
                'profession' => 'dummy text',
                'jobhun_info' => 'Instagram',
                'batch' => '1',
                'academy_id' => 3,
                'creator_id' => 1
            ],
        ];

        foreach ($seeds as $key => $seed) {
            AcademyRegistrant::create($seed);
        }
    }
}
