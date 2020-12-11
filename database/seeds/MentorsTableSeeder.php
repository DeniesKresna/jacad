<?php

use Illuminate\Database\Seeder;

use App\Models\Mentor;

class MentorsTableSeeder extends Seeder
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
                'name' => 'Mentor 1',
                'description' => '<p>Profesi: Head of Marketing Communication</p><p>Asal perusahaan: Ex PT PP Properti Tbk</p><p>Bidang yang dikuasai: Branding Development, Graphic Design, Marketing Communication</p><p>Materi yang akan diajar dalam bentuk pembahasan: Teori, study case, karier, tools </p><p>Latar belakang pendidikan: Sarjana jurusan Desain Komunikasi Visual di Institut Teknologi Sepuluh November (2009-2015)</p><p>Pengalaman:
                </p><p><br></p><p></p><p><br></p><p></p>',
                'linkedIn_url' => 'linkedIn/mentor-1',
                'url_name' => 'mentor-1',
                'url' => config('app.url').'/mentors/mentor-1',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/11/48-600x600.jpg',
                'image_path' => '',
                'creator_id' => 1
            ],

            [
                'name' => 'Mentor 2',
                'description' => '<p>Profesi: Head of Marketing Communication</p><p>Asal perusahaan: Ex PT PP Properti Tbk</p><p>Bidang yang dikuasai: Branding Development, Graphic Design, Marketing Communication</p><p>Materi yang akan diajar dalam bentuk pembahasan: Teori, study case, karier, tools </p><p>Latar belakang pendidikan: Sarjana jurusan Desain Komunikasi Visual di Institut Teknologi Sepuluh November (2009-2015)</p><p>Pengalaman:
                </p><p><br></p><p></p><p><br></p><p></p>',
                'linkedIn_url' => 'linkedIn/mentor-2',
                'url_name' => 'mentor-2',
                'url' => config('app.url').'/mentors/mentor-2',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/11/48-600x600.jpg',
                'image_path' => '',
                'creator_id' => 1
            ],

            [
                'name' => 'Mentor 3',
                'description' => '<p>Profesi: Head of Marketing Communication</p><p>Asal perusahaan: Ex PT PP Properti Tbk</p><p>Bidang yang dikuasai: Branding Development, Graphic Design, Marketing Communication</p><p>Materi yang akan diajar dalam bentuk pembahasan: Teori, study case, karier, tools </p><p>Latar belakang pendidikan: Sarjana jurusan Desain Komunikasi Visual di Institut Teknologi Sepuluh November (2009-2015)</p><p>Pengalaman:
                </p><p><br></p><p></p><p><br></p><p></p>',
                'linkedIn_url' => 'linkedIn/mentor-3',
                'url_name' => 'mentor-3',
                'url' => config('app.url').'/mentors/mentor-3',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/11/48-600x600.jpg',
                'image_path' => '',
                'creator_id' => 1
            ],
            
            [
                'name' => 'Mentor 4',
                'description' => '<p>Profesi: Head of Marketing Communication</p><p>Asal perusahaan: Ex PT PP Properti Tbk</p><p>Bidang yang dikuasai: Branding Development, Graphic Design, Marketing Communication</p><p>Materi yang akan diajar dalam bentuk pembahasan: Teori, study case, karier, tools </p><p>Latar belakang pendidikan: Sarjana jurusan Desain Komunikasi Visual di Institut Teknologi Sepuluh November (2009-2015)</p><p>Pengalaman:
                </p><p><br></p><p></p><p><br></p><p></p>',
                'linkedIn_url' => 'linkedIn/mentor-4',
                'url_name' => 'mentor-4',
                'url' => config('app.url').'/mentors/mentor-4',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/11/48-600x600.jpg',
                'image_path' => '',
                'creator_id' => 1
            ],

            [
                'name' => 'Mentor 5',
                'description' => '<p>Profesi: Head of Marketing Communication</p><p>Asal perusahaan: Ex PT PP Properti Tbk</p><p>Bidang yang dikuasai: Branding Development, Graphic Design, Marketing Communication</p><p>Materi yang akan diajar dalam bentuk pembahasan: Teori, study case, karier, tools </p><p>Latar belakang pendidikan: Sarjana jurusan Desain Komunikasi Visual di Institut Teknologi Sepuluh November (2009-2015)</p><p>Pengalaman:
                </p><p><br></p><p></p><p><br></p><p></p>',
                'linkedIn_url' => 'linkedIn/mentor-5',
                'url_name' => 'mentor-5',
                'url' => config('app.url').'/mentors/mentor-5',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2020/11/48-600x600.jpg',
                'image_path' => '',
                'creator_id' => 1
            ],
        ];

        foreach ($seeds as $key => $seed) {
            Mentor::create($seed);
        }
    }
}
