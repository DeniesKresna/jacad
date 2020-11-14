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

    private $seeds;

    public function __construct()
    {
        $this->seeds= [
            [
                'company_id' => 1,
                'position' => 'Web Programmer',
                'type' => 'Full Time',
                'location_id' => 1,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 2,
                'position' => 'Web Designer',
                'type' => 'Full Time',
                'location_id' => 2,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 3,
                'position' => 'System Analyst',
                'type' => 'Full Time',
                'location_id' => 3,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 1,
                'position' => 'Grahphic Designer',
                'type' => 'Full Time',
                'location_id' => 4,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 2,
                'position' => 'Illustrator',
                'type' => 'Full Time',
                'location_id' => 5,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 3,
                'position' => 'Mobile App Developer',
                'type' => 'Full Time',
                'location_id' => 1,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 1,
                'position' => 'IOS Developer',
                'type' => 'Full Time',
                'location_id' => 2,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 2,
                'position' => 'Front-end Developer (React.js)',
                'type' => 'Full Time',
                'location_id' => 3,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ],

            [
                'company_id' => 3,
                'position' => 'Back-end Developer (Express.js)',
                'type' => 'Full Time',
                'location_id' => 4,
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
                'creator_id' => 1,
                'expired' => date('Y-m-d') 
            ]
        ];
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            Job::create($seed);
        }
    }
}
