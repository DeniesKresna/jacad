<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'name' => "Admnistrator",
                'email' => "barbar.smartit@gmail.com",
                'phone' =>" 08157006008",
                'username' => "barbar",
                'password' => Hash::make('barbar123!!!'),
            ],

            [
                'name' => "Denies Kresna",
                'email' => "denies@smart-it.co.id",
                'phone' => "08157006008",
                'username' => "barbar",
                'password' => Hash::make('denies123!!!'),
                'active' => 1
            ],
    
            [
                'name' => "Septian",
                'email' => "septiano@smart-it.co.id",
                'phone' => "08157006008",
                'username' => "septiano",
                'password' => Hash::make('12345678'),
                'active' => 1
            ],
    
            [
                'name' => 'Jonathan Gani',
                'email' => 'jonathangani279@gmail.com',
                'phone' => '08157006008',
                'username' => 'syndic2',
                'password' => password_encrypt("asdasd"),
                'active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        foreach ($seeds as $key => $seed) {
            User::create($seed);
        }
    }
}
