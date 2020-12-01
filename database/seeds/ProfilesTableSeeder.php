<?php

use Illuminate\Database\Seeder;

use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
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
                'user_id' => 5,
                'description' => 'Saya bekerja di STTS sebagai mahasiswa',
                'domicile' => 'Surabaya',
                'birth_date' => date("Y-m-d H:i:s"),
                'facebook_url' => 'facebook.com/user-profile/dummy',
                'linkedIn_url' => 'linkedIn.com/user-profile/dummy'
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Profile::create($seed);
        }
    }
}
