<?php

use Illuminate\Database\Seeder;

use App\Models\Location;

class LocationsTableSeeder extends Seeder
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
                'name' => 'Jakarta',
                'creator_id' => 1
            ],

            [
                'name' => 'Surabaya',
                'creator_id' => 1
            ],

            [
                'name' => 'Malang',
                'creator_id' => 1
            ],

            [
                'name' => 'Jogjakarta',
                'creator_id' => 1
            ],

            [
                'name' => 'Bali',
                'creator_id' => 1
            ],
        ];

        foreach ($seeds as $key => $seed) {
            Location::create($seed);
        }
    }
}
