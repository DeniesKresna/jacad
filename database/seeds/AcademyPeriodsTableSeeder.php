<?php

use App\Models\Academy;
use Illuminate\Database\Seeder;

use App\Models\AcademyPeriod;

class AcademyPeriodsTableSeeder extends Seeder
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
                'period' => 'Periode A',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode A',
                'academy_id' => 1,
                'active' => 1
            ],

            [
                'period' => 'Periode A',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode A',
                'academy_id' => 2,
                'active' => 1
            ],

            [
                'period' => 'Periode A',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode A',
                'academy_id' => 3,
                'active' => 1
            ],
            
            [
                'period' => 'Periode B',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode B',
                'academy_id' => 1
            ],

            [
                'period' => 'Periode B',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode B',
                'academy_id' => 2
            ],

            [
                'period' => 'Periode B',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode B',
                'academy_id' => 3
            ],

            [
                'period' => 'Periode C',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode C',
                'academy_id' => 1
            ],

            [
                'period' => 'Periode C',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode C',
                'academy_id' => 2
            ],

            [
                'period' => 'Periode C',
                'price' => 700000,
                'description' => 'Jobhun Academy Periode C',
                'academy_id' => 3
            ]
        ];

        foreach ($seeds as $key => $seed) {
            AcademyPeriod::create($seed);
        }
    }
}
