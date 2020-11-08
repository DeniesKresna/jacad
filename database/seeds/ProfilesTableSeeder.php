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

    private $seeds;
    
    public function __construct()
    {
        $this->seeds= [
            [
                'user_id' => 4,
                'desc' => 'dummy_text',
                'domicile' => 'Surabaya',
                'date_of_birth' => date("Y-m-d H:i:s"),
                'facebook_url' => 'facebook.com/user-profile/dummy',
                'linkedIn_url' => 'linkedIn.com/user-profile/dummy'
            ]
        ];
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            Profile::create($seed);
        }
    }
}
