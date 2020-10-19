@extends('layouts.user')

@section('banner')
    @include('partial.header.title')
@endsection

@section('content')
    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            <strong>Jobhun Student Ambassador</strong>
                        </h2>
                        <div class="heading">
                            <img src="https://jobhun.id/wp-content/uploads/2020/07/WhatsApp-Image-2020-07-01-at-16.38.31-1024x576.jpeg" class="img-fluid"/>
                        </div>

                        <h4>
                            <strong>Hai, mahasiswa. Kamu bisa mengenal dunia kerja dan mengembangkan kariermu melalui Jobhun Student Ambassador!</strong>
                        </h4>
                        <p>Jobhun Student Ambassador adalah sebuah program yang memberikan peluang bagi seluruh mahasiswa di Indonesia untuk bersama-sama menyebarkan awareness terkait pentingnya pengembangan karier dengan memperkenalkan program & layanan Jobhun secara online.</p>

                        <h4>
                            <strong>Peran Jobhun Student Ambassador</strong>
                        </h4>
                        <ol>
                            <li>Mempromosikan value Jobhun untuk meningkatkan kesadaran generasi milenial dan z terhadap pengembangan karier</li>
                            <li>Mengedukasi mahasiswa untuk mengenal layanan dan program Jobhun</li>
                            <li>Menjadi fasilitator bagi mahasiswa yang tertarik menggunakan layanan dan program Jobhun</li>
                            <li>Berkontribusi dalam merancang strategi pengembangan Jobhun di masing-masing kampus berdasarkan pengamatan kebutuhan mahasiswa terhadap pengembangan karier</li>
                            <li>Mengorganisir Jobhun Student Ambassador di kampus masing-masing dan melibatkan teman-teman mahasiswa dalam acara tersebut</li>
                        </ol>

                        <h4>
                            <strong>Keuntungan menjadi Jobhun Student Ambassador</strong>
                        </h4>
                        <ol>
                            <li>Mendapatkan mentoring untuk beberapa topik yang bermanfaat untuk pengembangan karier, seperti personal branding, career development 101, startup development, creative content, personal branding, communication/public speaking, dan leadership.</li>
                            <li>Mendapatkan 1 kali kelas gratis di Jobhun Academy</li>
                            <li>Mendapatkan akses untuk menghadiri acara-acara Jobhun secara gratis, seperti Jobhun Talks, Jobhun Class, Jobhun Visit, dan lainnya.</li>
                            <li>Menambah income melalui komisi yang didapat dari peserta yang berhasil diajak mendaftar ke Jobhun Academy dengan menggunakan referral code</li>
                            <li>E-Certificate</li>
                            <li>Surat rekomendasi kerja</li>
                            <li>Memperluas network di seluruh Indonesia</li>
                            <li>Kesempatan berkarier di Jobhun</li>
                        </ol>

                        <h4>
                            <strong>Syarat dan kualifikasi menjadi Jobhun Student Ambassador</strong>
                        </h4>
                        <ol>
                            <li>Mahasiswa aktif berusia 17-23 tahun</li>
                            <li>Aktif berorganisasi di dalam/luar kampus</li>
                            <li>Berminat memperdalam dan memiliki ide kreatif yang berkaitan dengan startup</li>
                            <li>Memiliki kemampuan komunikasi yang baik</li>
                            <li>Senang bertemu dengan orang baru</li>
                            <li>Disiplin, berkomitmen, dan taat pada aturan.</li>
                        </ol>

                        <h4>
                            <strong>Segera daftarkan dirimu untuk menjadi Jobhun Student Ambassador!</strong>
                        </h4>
                        <p>Untuk mendaftar menjadi Jobhun Student Ambassador, silakan perhatikan alur berikut ini:</p>
                        <ol>
                            <li>Mengisi formulir di bawah ini</li>
                            <li>
                                Mengunggah twibbon pada Instagram (Akun Instagram jangan diprivate). Twibon bisa diunduh di sini. Buat caption semenarik mungkin dengan hastag #JobhunStudentAmbassador. Kemudian tag 3 teman di postingan, tag @jobhun, dan tag @jobhunstudentambassador. Share postingan twibbon ini melalui fitur Story pada Instagram. Silakan unduh twibbon <a href="https://jobhun.id/wp-content/uploads/2020/07/TWIBBON-01.png">di sini.</a>
                            </li>
                            <li>Pengisian formulir dan mengunggah Twibbon paling lambat 10 Juli 2020</li>
                            <li>Seluruh peserta yang lolos seleksi administrasi akan diundang untuk inteview melalui Zoom. Pengumuman lolos seleksi administrasi akan diumumkan melalui email.</li>
                        </ol>
                        
                        @include('pages.student-ambassador.create')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection