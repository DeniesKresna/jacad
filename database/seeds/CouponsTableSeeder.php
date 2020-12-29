<?php

use Illuminate\Database\Seeder;

use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
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
                'code' => 'JOBHUN-SIMPLE',
                'type' => 'simple',
                'cut' => 100000,
                'description' => 'Langsun terpotong sebesar Rp 100.000'
            ],

            [
                'code' => 'JOBHUN-PAHE',
                'type' => 'pahe',
                'cut' => 100000,
                'extra_variable' => 2,
                'description' => 'Minimal ambil 2 kelas terlebih dahulu'
            ],
        ];

        foreach ($seeds as $key => $seed) {
            Coupon::create($seed);
        }
    }
}
