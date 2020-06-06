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
            $datas = $datas->orWhere('title','like',"%".$search."%")
                            ->orWhere('url','like',"%".$search."%");
        }
        $datas = $datas->with(['author'=>function($query) use ($search){
            $query->orWhere('name','like',"%".$search."%");
        }]);

        $datas = $datas->orderBy("id","desc")->paginate($page_size,["*"],"page",$page);
        return response()->json($datas);
    }

    public function store(Request $request){
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas["author_id"] = 1;
        $datas['url'] = str_replace(" ", "-", strtolower($request->title));

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return response()->json(['fail'=>false,'message'=>$validator->messages()],422);

        $post = Post::create($datas);
        if($post){
            $post->categories()->attach($request->categories);
            return response()->json(['data'=>$post,'message'=>'post created']);
        }
        else
            return response()->json(["message"=>"cant create post"],400);
    }

    public function show($id)
    {
        $data = Playlist::with(['contents' => function($q){
            $q->orderBy('order_no');
        },'customer'])->findOrFail($id);
        return self::success_responses($data);
    }

    public function destroy(Request $request, $id){
        $res = Playlist::findOrFail($id);
        $res->contents()->detach();
        $res->delete();
        return self::success_responses();
    }
}

