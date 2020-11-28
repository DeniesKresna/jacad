<?php

use Illuminate\Database\Seeder;

use App\Models\AskCareer;

class AskCareersTableSeeder extends Seeder
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
                'name' => 'Mentor Copywriting',
                'schedule' => '<p>Jadwal dan waktu yang tersedia untuk mentoring: Senin-Jumat pukul 18.30-20.00 WIB, Sabtu-Minggu pukul 10.00-12.00 WIB</p>',
                'price' => 700000,
                'mentor_id' => 1
            ],

            [
                'name' => 'Mentor SEO Specialist',
                'schedule' => '<p>Jadwal dan waktu yang tersedia untuk mentoring: Senin-Jumat pukul 18.30-20.00 WIB, Sabtu-Minggu pukul 10.00-12.00 WIB</p>',
                'price' => 700000,
                'mentor_id' => 2
            ],

            [
                'name' => 'Mentor Public Speaking & Voice Over',
                'schedule' => '<p>Jadwal dan waktu yang tersedia untuk mentoring: Senin-Jumat pukul 18.30-20.00 WIB, Sabtu-Minggu pukul 10.00-12.00 WIB</p>',
                'price' => 700000,
                'mentor_id' => 3
            ],

            [
                'name' => 'Mentor Software Development',
                'schedule' => '<p>Jadwal dan waktu yang tersedia untuk mentoring: Senin-Jumat pukul 18.30-20.00 WIB, Sabtu-Minggu pukul 10.00-12.00 WIB</p>',
                'price' => 700000,
                'mentor_id' => 4
            ],
            
            [
                'name' => 'Mentor Marketing Communication',
                'schedule' => '<p>Jadwal dan waktu yang tersedia untuk mentoring: Senin-Jumat pukul 18.30-20.00 WIB, Sabtu-Minggu pukul 10.00-12.00 WIB</p>',
                'price' => 700000,
                'mentor_id' => 5
            ]
        ];

        foreach ($seeds as $key => $seed) {
            AskCareer::create($seed);
        }
    }
}
