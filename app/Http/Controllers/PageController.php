<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\AskCareer;
use App\Models\Job;

class PageController extends Controller
{
    public function admin() {
        return view('layouts.admin');
    }

    public function home() {
        $academies= Academy::limit(6)->get();
        $ask_careers= AskCareer::limit(6)->get();
        //$career_hubs= Job::limit(6)->get();
        $career_hubs= [1, 2, 3, 4, 5, 6];

        //IF LOCATION SEMENTARA
        /*foreach ($career_hubs as $key => $career_hub) { 
            if ($career_hub->location_id == 1) $career_hub->location= 'Jakarta';
            else if ($career_hub->location_id == 2) $career_hub->location= 'Surabaya';
            else if ($career_hub->location_id == 3) $career_hub->location= 'Yogyakarta'; 
        }*/

        $testimonies= [
            (object)[
                'name' => 'Antonia Kinathi Asari',
                'position' => 'Peserta Jobhun Academy: Content Writer',
                'review' => 'Setelah ikut Jobhun Academy: Content Writer ini, aku merasa lebih percaya diri. Awalnya aku tidak merasa memiliki keahlian, tetapi sekarang aku lebih percaya diri untuk menulis. Mentornya sangat menyenangkan dan friendly, tim Jobhun yang ramah, sistem pembayaran yang mudah dan jelas, serta tempat yang nyaman.',
                'img_url' => 'https://jobhun.id/wp-content/uploads/2019/05/WhatsApp-Image-2019-05-23-at-15.51.58.jpeg'
            ],

            (object)[
                'name' => 'Restyo Fitrianto Nurahman',
                'position' => 'Peserta Jobhun Academy: Graphic Designer',
                'review' => 'Jobhun Academy: Graphic Designer yang aku ikuti ini oke banget, bisa menambah pengalaman, ilmu, dan relasi. Tidak rugi sama sekali deh! Jadi pengen ikut kelas lainnya lagi, tapi masih nunggu rezeki hehehe. Terima kasih Jobhun!',
                'img_url' => 'https://jobhun.id/wp-content/uploads/2019/05/WhatsApp-Image-2019-05-23-at-15.51.30.jpeg'
            ],

            (object)[
                'name' => 'Faishal Rusydan',
                'position' => 'UI/UX Designer Intern di PT Davinti Group',
                'review' => 'Berkat Jobhun cari magang jadi cepat sekali, langsung dapet tawaran magang tanpa perlu menunggu terlalu lama. Terima kasih Jobhun.',
                'img_url' => 'https://jobhun.id/wp-content/uploads/2019/06/WhatsApp-Image-2019-06-14-at-09.32.52.jpeg'
            ],

            (object)[
                'name' => 'Sahisnu Dewana Efraim',
                'position' => 'Tuupai.com',
                'review' => 'Tuupai menggunakan layanan Jobhun Career Hub Premium saat perekrutan untuk program internship. Sangat efisien dalam hal waktu, sehingga kami tidak membuang banyak tenaga untuk melempar lowongan-lowongan magang ke tempat lain, juga dibantu seleksi oleh tim Jobhun sendiri yang menurut kami sangat membantu sekali. Jobhun merupakan solusi yang efisien untuk perusahaan/startup dalam mencari talenta-talenta muda yang berkualitas.',
                'img_url' => 'https://jobhun.id/wp-content/uploads/2019/02/download.jpg'
            ]
        ];

        return view('index', [ 
            'academies' => $academies,
            'ask_careers' => $ask_careers,
            'career_hubs' => $career_hubs,
            'testimonies' => $testimonies
        ]);
    }

    public function studentAmbassador() {
        return view('pages.student-ambassador.opening', ['title' => 'Student Ambassador']);
    }
}
