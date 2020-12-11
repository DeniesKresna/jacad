<?php

use Illuminate\Database\Seeder;

use App\Models\Blog;

class BlogsTableSeeder extends Seeder
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
                'title' => 'Jobhun Internship 1',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-1170x471.jpg',
                'image_path' => '',
                'url_title' => 'jobhun-internship-1',
                'url' => config('app.url').'/blogs/jobhun-internship-1',
                'content' => '<p>Di zaman serba mudah seperti sekarang ini, sebenarnya tidak begitu sulit menemukan lowongan pekerjaan dibanding beberapa dekade yang lalu. Hanya dengan menggerakkan ujung jari, kita sudah bisa menemukan banyak lowongan pekerjaan melalui internet. Namun, mengapa masih banyak orang yang mengeluhkan susahnya dapat pekerjaan?
                Rupanya, kalau ditelusuri lebih dalam, hal yang membuat masih banyak orang kesulitan mencari pekerjaan bukanlah karena kurang tersedianya lowongan kerja, melainkan adanya gap/jurang pemisah antara kemampuan yang didapatkan dari pendidikan akademik dengan kemampuan yang diperlukan oleh user atau orang yang menggunakan jasa pekerja. Karena biasanya, perkembangan di dunia kerja lebih dinamis daripada kurikulum pendidikan. Lalu bagaimana cara mengatasinya? Sebagai pencari kerja, kita bisa menipiskan jarak yang ada itu dengan mengikuti magang atau internship. Dengan magang, kita bisa belajar untuk mengaplikasikan ilmu yang kita dapat di sekolah atau kuliah di bidang yang kita geluti, secara langsung.
                Sebagai sebuah platform pengembangan karier untuk milenial, Jobhun tentu tidak mau ketinggalan dalam hal internship ini. Jobhun menyadari betapa pentingnya melakukan magang bagi calon pekerja. Untuk itu, Jobhun sudah beberapa kali mengadakan Jobhun Internship. Sampai bulan Februari 2019 kemarin, Jobhun sudah memiliki 5 batch intern.
                Pada Jobhun Internship Batch 5 yang diadakan selama tiga bulan terhitung sejak November 2018 hingga Februari 2019 kemarin, ada sembilan orang anak magang/intern yang dibagi dalam lima divisi. Divisi tersebut antara lain content writer, public relations, videographer, web developer, dan business development. Para anak intern ini benar-benar diajak untuk mencicipi asyiknya kerja di startup digital seperti Jobhun dengan melakukan pekerjaan yang memang biasanya dikerjakan oleh Tim Jobhun. Mereka dibebaskan untuk berkreasi dalam jobdesc-nya masing-masing dengan didampingi oleh satu orang supervisor dari Tim Jobhun di masing-masing divisi.
                Selama masa magang, selain melakukan tugas sesuai divisinya, para intern juga bisa belajar banyak melalui sejumlah mentoring yang mengundang orang-orang yang memang sudah ahli di bidangnya. Misalnya mentoring langsung dengan Febinska, creative director Captivate Indonesia ketika belajar tentang bagaimana cara membuat event atau bagaimana membuat konten yang menarik dengan Joe Adimara, content creator dan creative director @exploreindonesia. Selain bisa digunakan untuk menunjang kegiatan mereka selama magang, mentoring ini juga diharapkan bisa bermanfaat untuk menambah kemampuan para intern sebelum nantinya memasuki dunia kerja.</p>',
                'category_id' => 1,
                'author_id' => 1
            ],
            
            [
                'title' => 'Jobhun Internship 2',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'jobhun-internship-2',
                'url' => config('app.url').'/blogs/jobhun-internship-2',
                'content' => '<p>Testing Jobhun Internship 2</p',
                'category_id' => 1,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Talks 1',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'jobhun-talks-1',
                'url' => config('app.url').'/blogs/jobhun-talks-1',
                'content' => '<p>Testing Jobhun Talks 1</p',
                'category_id' => 2,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Talks 2',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'jobhun-talks-2',
                'url' => config('app.url').'/blogs/jobhun-talks-2',
                'content' => '<p>Testing Jobhun Talks 2</p',
                'category_id' => 2,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Visit 1',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'jobhun-visit-1',
                'url' => config('app.url').'/blogs/jobhun-visit-1',
                'content' => '<p>Testing Jobhun Visit 1</p',
                'category_id' => 3,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Visit 2',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'jobhun-visit-2',
                'url' => config('app.url').'/blogs/jobhun-visit-2',
                'content' => '<p>Testing Jobhun Visit 2</p',
                'category_id' => 3,
                'author_id' => 1
            ],

            [
                'title' => 'Blog Artikel 1',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'blog-artikel-1',
                'url' => config('app.url').'/blogs/blog-artikel-1',
                'content' => '<p>Testing Blog Artkel 1</p',
                'category_id' => 4,
                'author_id' => 1
            ],
            
            [
                'title' => 'Blog Artkel 2',
                'image_url' => 'https://jobhun.id/wp-content/uploads/2019/07/IMG-20190228-WA0046-600x450.jpg',
                'image_path' => '',
                'url_title' => 'blog-artikel-2',
                'url' => config('app.url').'/blogs/blog-artikel-2',
                'content' => '<p>Testing Blog Artikel 2</p',
                'category_id' => 4,
                'author_id' => 1
            ]
        ];

        foreach ($seeds as $key => $seed) {
            Blog::create($seed);
        }
    }
}
