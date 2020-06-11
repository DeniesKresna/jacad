<?php

namespace App\Http\Controllers\web;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $page = $request->page;
        if($request->page_size)
        	$page_size = $request->page_size;
        else
        	$page_size = 10;

        $posts = Post::with('author')->orderBy("id","desc")->paginate($page_size);
        $recentposts = Post::orderBy("created_at","desc")->limit(3)->get();
        $categories = Category::orderBy('name')->get();
        return view('blog.list',["posts"=>$posts, "categories"=>$categories, "recent_posts"=>$recentposts]);
    }

    public function indexCategory(Request $request, $category)
    {
        $page = $request->page;
        if($request->page_size)
            $page_size = $request->page_size;
        else
            $page_size = 10;

        $posts = Post::with('author')->whereHas('categories', function($q) use ($category){
            $q->where('name',$category);
        })->orderBy("id","desc")->paginate($page_size);
        $recentposts = Post::orderBy("created_at","desc")->limit(3)->get();
        $categories = Category::orderBy('name')->get();
        return view('blog.list',["posts"=>$posts, "categories"=>$categories, "ctg"=>$category, "recent_posts"=>$recentposts]);
    }

    public function getFromTitle($url_title){
    	$post = Post::where('url_title',$url_title)->first();
    	$post->prev_post = Post::where('created_at','<',$post->created_at)->orderBy('id','desc')->first(['title','url']);
    	$post->next_post = Post::where('created_at','>',$post->created_at)->orderBy('id','asc')->first(['title','url']);
        $recentposts = Post::orderBy("created_at","desc")->limit(3)->get();
        $categories = Category::orderBy('name')->get();
    	return view('blog.show',["post"=>$post->load(['categories']), "categories"=>$categories, "recent_posts"=>$recentposts]);
    }
}
