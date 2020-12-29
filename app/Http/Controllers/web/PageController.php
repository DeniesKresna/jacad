<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\AskCareer;
use App\Models\Job;
use App\Models\Blog;
use App\Models\Location;

class PageController extends Controller
{
    public function admin() {
        return view('layouts.admin');
    }

    public function home() {
        $academies= Academy::whereHas('periods', function($query) {
            $query->where('active', 1);
        })
        ->limit(6)
        ->get();
        $ask_careers= AskCareer::limit(6)->get();
        $jobs= Job::limit(6)->get();
        $blogs= Blog::limit(3)->get();
        $locations= Location::all();

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
            'jobs' => $jobs,
            'blogs' => $blogs,
            'testimonies' => $testimonies,
            'locations' => $locations
        ]);
    }
}
