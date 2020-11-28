<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
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
                'name' => 'super_admin',
                'display_name' => 'Admin Page',
                'description' => 'Super Admin'
            ],

            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Customer',
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Role::create($seed);
        }
    }
}
