<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    public function index(Request $request) {
        $page_size = $request->page ? $request->page_size : 10;
        $blogs= Blog::with('author')->orderBy('id', 'desc')->paginate($page_size);
        $recent_blogs= Blog::orderBy('created_at', 'desc')->limit(3)->get();
        $categories = Category::orderBy('name')->get();
        
        return view('pages.blog.list', [
            'blogs' => $blogs,
            'recent_blogs' => $recent_blogs,
            'categories' => $categories
        ]);
    }

    public function indexCategory(Request $request, $category) {        
        $page_size = $request->page ? $request->page_size : 10;
        $category= ucwords(implode(' ',explode('-', $category)));
        $blogs= Blog::with('author')->whereHas('category', function($query) use ($category) {
            $query->where('name', $category);
        })->orderBy('id', 'desc')->paginate($page_size);
        $recent_blogs= Blog::orderBy('created_at', 'desc')->limit(3)->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.blog.list', [
            'blogs' => $blogs,
            'recent_blogs' => $recent_blogs,
            'categories' => $categories
        ]);
    }
    
    public function getFromTitle($url_title) {
        $blog= Blog::where('url_title', $url_title)->firstOrFail();
        $blog->prev_post = Blog::where('created_at', '<', $blog->created_at)->orderBy('id', 'desc')->first(['title', 'url']);
    	$blog->next_post = Blog::where('created_at', '>', $blog->created_at)->orderBy('id', 'asc')->first(['title', 'url']);
        $recent_blogs= Blog::orderBy('created_at', 'desc')->limit(3)->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.blog.show', [
            'blog' => $blog,
            'recent_blogs' => $recent_blogs,
            'categories' => $categories
        ]);
    }
}
