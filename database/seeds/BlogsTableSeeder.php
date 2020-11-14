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

    private $seeds;
    
    public function __construct()
    {
        $this->seeds= [
            [
                'title' => 'Jobhun Internship 1',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'jobhun-internship-1',
                'url' => 'http://localhost/magang/jacad/public/blogs/jobhun-internship-1',
                'content' => '<p>Testing Jobhun Internship 1</p',
                'category_id' => 1,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Internship 2',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'jobhun-internship-2',
                'url' => 'http://localhost/magang/jacad/public/blogs/jobhun-internship-2',
                'content' => '<p>Testing Jobhun Internship 2</p',
                'category_id' => 1,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Talks 1',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'jobhun-talks-1',
                'url' => 'http://localhost/magang/jacad/public/blogs/jobhun-talks-1',
                'content' => '<p>Testing Jobhun Talks 1</p',
                'category_id' => 2,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Talks 2',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'jobhun-talks-2',
                'url' => 'http://localhost/magang/jacad/public/blogs/jobhun-talks-2',
                'content' => '<p>Testing Jobhun Talks 2</p',
                'category_id' => 2,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Visit 1',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'jobhun-visit-1',
                'url' => 'http://localhost/magang/jacad/public/blogs/jobhun-visit-1',
                'content' => '<p>Testing Jobhun Visit 1</p',
                'category_id' => 3,
                'author_id' => 1
            ],

            [
                'title' => 'Jobhun Visit 2',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'jobhun-visit-2',
                'url' => 'http://localhost/magang/jacad/public/blogs/jobhun-visit-2',
                'content' => '<p>Testing Jobhun Visit 2</p',
                'category_id' => 3,
                'author_id' => 1
            ],

            [
                'title' => 'Blog Artikel 1',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'blog-artikel-1',
                'url' => 'http://localhost/magang/jacad/public/blogs/blog-artikel-1',
                'content' => '<p>Testing Blog Artkel 1</p',
                'category_id' => 4,
                'author_id' => 1
            ],

            [
                'title' => 'Blog Artkel 2',
                'image_url' => 'http://localhost/magang/jacad/public/gallery/screen/medias/1604927261_1.jpg',
                'image_path' => 'screen/medias/1604927261_1.jpg',
                'url_title' => 'blog-artikel-2',
                'url' => 'http://localhost/magang/jacad/public/blogs/blog-artikel-2',
                'content' => '<p>Testing Blog Artikel 2</p',
                'category_id' => 4,
                'author_id' => 1
            ],
        ];
    }

    public function run()
    {
        foreach ($this->seeds as $key => $seed) {
            Blog::create($seed);
        }
    }
}
