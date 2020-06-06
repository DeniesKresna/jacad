<?php

namespace App\Http\Controllers\v1\Device;

use App\Http\Controllers\ApiController;
use App\Models\DeviceRequestLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends ApiController
{

    public function index(Request $request){
        $from = date("Y-m-d 00:00:00");
        if($request->has('from')){
            $from = $request->from;
        }
        $data = DeviceRequestLog::where('created_at','>=',$from)->orderBy('created_at','desc')->get();
        return response()->json($data);
    }

    public function all(Request $request){
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;

        $from = date("2000-01-01");
        if($request->has('from')){
            $from = date("Y-m-d", strtotime($request->from));
        }
        $datas = DeviceRequestLog::where('id','>',0);
        if($request->has('imei')){
        	$datas->where('imei',$request->imei);
        }	
        if($request->has('description')){
        	$datas->where('description','like',"%".$request->description."%");
        }
        $datas = $datas->where('created_at','like',$from."%")->orderBy('created_at','desc')->paginate($page_size,["*"],"page",$page);

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
}