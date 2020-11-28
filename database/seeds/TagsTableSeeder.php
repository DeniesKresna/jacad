<?php

use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagsTableSeeder extends Seeder
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
                'name' => 'Tag 1',
                'creator_id' => 1
            ],

            [
                'name' => 'Tag 2',
                'creator_id' => 1
            ],

            [
                'name' => 'Tag 3',
                'creator_id' => 1
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Tag::create($seed);
        }
    }
}
