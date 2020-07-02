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
    }
}
