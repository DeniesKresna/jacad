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
        $session_id = $request->get('auth')->user->id;
        $datas["customer_id"] = $session_id;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

        $playlist = Playlist::create($datas);
        if($playlist){
            if($request->file_ids){
                $sync_data = [];
                $order_no = 1;
                foreach($request->file_ids as $file_id){
                    $sync_data[$file_id] = array('order_no'=>$order_no);
                    $order_no++;
                }
                $playlist->contents()->sync($sync_data);
            }
        }
        else
            return self::error_responses("Unknown error");

        return self::success_responses($playlist->load(['contents' => function($q){
            $q->orderBy('order_no');
        }]));
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

