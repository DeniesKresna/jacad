<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $datas = Post::where('id','>',0);
        if($request->has('search')){
            $datas = $datas->where('title','like',"%".$search."%")
                            ->orWhere('url','like',"%".$search."%");
        }
        $datas = $datas->with(['author'=>function($query) use ($search){
            $query->orWhere('name','like',"%".$search."%");
        }]);

        $datas = $datas->orderBy("id","desc")->paginate($page_size);
        return response()->json($datas);
    }

    public function show($id){
        return response()->json(Post::findOrFail($id)->load(['categories']));
    }

    public function store(Request $request){
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas["author_id"] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return response()->json(['fail'=>false,'message'=>$validator->messages()],422);

        $datas['url_title'] = str_replace(" ", "-", strtolower($request->title));
        $datas['url'] = url("/")."/blog/".$datas['url_title'];
        $upload = upload("/screen/medias/",$request->file('file'),'1');
        $datas['image_path'] = $upload;
        $datas['image_url'] = upload_dir().$upload;
        $post = Post::create($datas);
        if($post){
            $post->categories()->attach($datas['categories']);
            return response()->json(['data'=>$post,'message'=>'post created']);
        }
        else
            return response()->json(["message"=>"cant create post"],400);
    }

    public function update(Request $request, $id){
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas["author_id"] = 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return response()->json(['fail'=>false,'message'=>$validator->messages()],422);

        $datas['url_title'] = str_replace(" ", "-", strtolower($request->title));
        $datas['url'] = url("/")."/blog/".$datas['url_title'];

        $post = Post::findOrFail($id);
        if($post){
            $post->update($datas);
            $post->categories()->sync($request->categories);
            return response()->json(['data'=>$post,'message'=>'post updated']);
        }
        else
            return response()->json(["message"=>"cant update post"],400);
    }

    public function destroy(Request $request, $id){
        $post = Post::findOrFail($id);
        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                @unlink(base_upload_dir().$post->image_path);
                $post->categories()->detach();
                $post->forceDelete();
                return response()->json(['data'=>$post,'message'=>'post deleted']);
            }
        }
        $post->delete();
        return response()->json(['data'=>$post,'message'=>'post deleted']);
    }
}

