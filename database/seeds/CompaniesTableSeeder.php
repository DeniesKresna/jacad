<?php

use Illuminate\Database\Seeder;

use App\Models\Company;

class CompaniesTableSeeder extends Seeder
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
                'name' => "Sindikat Kreasi Digital 1",
                'tagline' => "Memenuhi mimpi dengan karya digital",
                'information' => "Dibentuk sejak 2016 dengan penuh cinta oleh kedua foundernya",
                'logo_url' => 'http://localhost:280/jacad/public/gallery/screen/medias/logos/bot.jpg',
                'logo_path' => '/screen/medias/logos/bot.jpg',
                'address' => 'Keputih Sukolilo no 1 Surabaya',
                'site_url' => 'jobhun.id',
                'phone' => '08157006001',
                'email' => 'skdig@gmail.com',
                'employee_amount' => '50-100',
                'updater_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

            [
                'name' => "Sindikat Kreasi Digital 2",
                'tagline' => "Memenuhi mimpi dengan karya digital",
                'information' => "Dibentuk sejak 2016 dengan penuh cinta oleh kedua foundernya",
                'logo_url' => 'http://localhost:280/jacad/public/gallery/screen/medias/logos/bot.jpg',
                'logo_path' => '/screen/medias/logos/bot.jpg',
                'address' => 'Keputih Sukolilo no 1 Surabaya',
                'site_url' => 'jobhun.id',
                'phone' => '08157006001',
                'email' => 'skdig@gmail.com',
                'employee_amount' => '50-100',
                'updater_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

            [
                'name' => "Sindikat Kreasi Digital 3",
                'tagline' => "Memenuhi mimpi dengan karya digital",
                'information' => "Dibentuk sejak 2016 dengan penuh cinta oleh kedua foundernya",
                'logo_url' => 'http://localhost:280/jacad/public/gallery/screen/medias/logos/bot.jpg',
                'logo_path' => '/screen/medias/logos/bot.jpg',
                'address' => 'Keputih Sukolilo no 1 Surabaya',
                'site_url' => 'jobhun.id',
                'phone' => '08157006001',
                'email' => 'skdig@gmail.com',
                'employee_amount' => '50-100',
                'updater_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]; 

        foreach ($seeds as $key => $seed) {
            Company::create($seed);
        }
    }
}
