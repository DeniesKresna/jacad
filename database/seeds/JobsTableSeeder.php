<?php

use Illuminate\Database\Seeder;

use App\Models\Job;

class JobsTableSeeder extends Seeder
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
                'position' => 'Web Programmer',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 1,
                'creator_id' => 1,
            ],

            [
                'position' => 'Web Designer',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 2,
                'creator_id' => 1, 
            ],

            [
                'position' => 'System Analyst',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 3,
                'creator_id' => 1,
            ],

            [
                'position' => 'Grahphic Designer',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 4,
                'creator_id' => 1,
            ],

            [
                'position' => 'Illustrator',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 2,
                'creator_id' => 1,
            ],

            [
                'position' => 'Mobile App Developer',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'location_id' => 2,
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'position' => 'IOS Developer',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 2,
                'creator_id' => 1,
            ],

            [
                'position' => 'Front-end Developer (React.js)',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'expired' => date('Y-m-d'),
                'verified' => 0,
                'location_id' => 2,
                'creator_id' => 1,
            ],

            [
                'position' => 'Back-end Developer (Express.js)',
                'type' => 'Full Time',
                'job_desc' => '<p>Deskripsi:</p><p>Pekerjaan yang dilakukan:</p><p>Syarat & Kualifikasi:</p><p>Kemampuan dan Kompetensi:</p>',
                'work_time' => '8 s/d 5',
                'dress_style' => 'Resmi',
                'language' => 'Bahasa Indonesia',
                'facility' => 'Jamsostek',
                'salary' => '3 - 4 Juta',
                'how_to_send' => 'Email atau dikirim lewat Pos ke alamat kami',
                'process_time' => '2 hari kerja',
                'jobhun_info' => 'Facebook',
                'verified' => 0,
                'expired' => date('Y-m-d'),
                'location_id' => 2,
                'creator_id' => 1,
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Job::create($seed);
        }
    }
}
