<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
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
                'name' => "Administrator",
                'email' => "barbar.smartit@gmail.com",
                'phone' =>" 08157006008",
                'username' => "barbar",
                'password' => password_encrypt('barbar123!!!'),
            ],

            [
                'name' => "Denies Kresna",
                'email' => "denies@smart-it.co.id",
                'phone' => "08157006008",
                'username' => "barbar",
                'password' => password_encrypt('denies123!!!'),
                'active' => 1
            ],
            
            [
                'name' => "Septian",
                'email' => "septiano@smart-it.co.id",
                'phone' => "08157006008",
                'username' => "septiano",
                'password' => password_encrypt('12345678'),
                'active' => 1
            ],
            
            [
                'name' => 'Admin Jonathan',
                'email' => 'jonathangani279@gmail.com',
                'phone' => '08157006008',
                'username' => 'jonsu1',
                'password' => password_encrypt('jonsu1'),
                'active' => 1
            ],

            [
                'name' => 'Customer Jonathan',
                'email' => 'jonathangani279@gmail.com',
                'phone' => '08157006008',
                'username' => 'jonsu2',
                'password' => password_encrypt('jonsu2'),
                'active' => 1
            ]
        ];

        foreach ($seeds as $key => $seed) {
            User::create($seed);
        }
    }
}
