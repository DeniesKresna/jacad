<?php

namespace App\Http\Controllers\web;

use App\Models\Post;
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

        $datas = Post::with('author')->orderBy("id","desc")->paginate($page_size);
        return view('blog.list',["posts"=>$datas]);
    }

    public function getFromTitle($url_title){
    	$post = Post::where('url_title',$url_title)->first();
    	$post->prev_post = Post::where('created_at','<',$post->created_at)->orderBy('id','desc')->first(['title','url']);
    	$post->next_post = Post::where('created_at','>',$post->created_at)->orderBy('id','asc')->first(['title','url']);
    	return view('blog.show',["post"=>$post->load(['categories'])]);
    }
}
