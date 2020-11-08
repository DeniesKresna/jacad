<?php

use Illuminate\Database\Seeder;

use App\Models\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $seeds= [
        [
            'user_id' => 1,
            'role_id' =>1,
        ],

        [
            'user_id' => 2,
            'role_id' => 2,
        ],

        [
            'user_id' => 3,
            'role_id' => 2,
        ],
        
        [
            'user_id' => 4,
            'role_id' => 2,
        ]
    ];

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            RoleUser::create($seed);
        }
    }
}
