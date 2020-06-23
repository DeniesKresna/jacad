<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class PlaylistController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;
        $datas = Playlist::where('id','>',0);
        if($request->has('customer_id')){
            $datas = $datas->where('customer_id',$request->customer_id);
        }
        $datas = $datas->orderBy("id","desc")->with(['contents' => function($q){
            $q->orderBy('order_no');
        },'customer'])->paginate($page_size,["*"],"page",$page);
        $data = [
            "total"=>$datas->total(),
            "page_size"=>$datas->perPage(),
            "page"=>$datas->currentPage(),
            "result"=>$datas->items(),
            "previous_page_url" => $datas->previousPageUrl(),
            "next_page_url" => $datas->nextPageUrl(),
        ];
        return self::success_responses($data);
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

