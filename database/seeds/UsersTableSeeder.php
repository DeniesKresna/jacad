<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = DB::table('roles')->insert([[
            'name'=>'super_admin',
            'display_name'=>'Admin Page',
            'description'=>'Super Admin',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
        ],
        [
            'name'=>'customer',
            'display_name'=>'Customer',
            'description'=>'Customer',
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s")
        ]]);

        $user = DB::table('users')->insert([
            [
                'name'=>"Admnistrator",
                'email'=>"barbar.smartit@gmail.com",
                'phone'=>"08157006008",
                'address'=>"Plampitan 12/24",
                'username'=>"barbar",
                'password'=>password_encrypt("barbar123!!!"),
                'active'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ],
            [
                'name'=>"Denies Kresna",
                'email'=>"denies@smart-it.co.id",
                'phone'=>"08157006008",
                'address'=>"Plampitan 12/24",
                'username'=>"barbar",
                'password'=>password_encrypt("denies123!!!"),
                'active'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ],
            [
                'name'=>"Septian",
                'email'=>"septiano@smart-it.co.id",
                'phone'=>"08157006008",
                'address'=>"Plampitan 12/24",
                'username'=>"septiano",
                'password'=>password_encrypt("12345678"),
                'active'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]
        ]);

        $user = DB::table('role_user')->insert([
            [
                'user_id'=>1,
                'role_id'=>1,
            ],
            [
                'user_id'=>2,
                'role_id'=>2,
            ],
            [
                'user_id'=>3,
                'role_id'=>2,
            ]
        ]);

        $res = DB::table('companies')->insert([
            [
                'name'=>"Sindikat Kreasi Digital",
                'tagline'=>"Memenuhi mimpi dengan karya digital",
                'information'=>"Dibentuk sejak 2016 dengan penuh cinta oleh kedua foundernya",
                'logo_url'=>'http://localhost:280/jacad/public/gallery/screen/medias/logos/bot.jpg',
                'logo_path'=>'/screen/medias/logos/bot.jpg',
                'address'=>'Keputih Sukolilo no 1 Surabaya',
                'site_url'=>'jobhun.id',
                'phone'=>'08157006001',
                'email'=>'skdig@gmail.com',
                'employee_amount'=>'50-100',
                'updater_id'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")

            ],
        ]);
    }
}
