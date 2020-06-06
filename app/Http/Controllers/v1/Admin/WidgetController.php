<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Widget;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;

class WidgetController extends ApiController
{

    /**
     * Accessing Widget Data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $page = !empty($request->page)?$request->page:1;
        $page_size = !empty($request->page_size)?$request->page_size:10;
        $datas = Widget::where('id','>',0);
        if($request->has('name')){
            $datas = $datas->where('name','like','%'.$request->name.'%');
        }
        $datas = $datas->orderBy("id","desc")->paginate($page_size,["*"],"page",$page);

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

    public function list(){
        $widgets = Widget::all();
        return self::success_responses($widgets);
    }

    public function store(Request $request){
        $datas = $request->all();
        $session_id = $request->get('auth')->user->id;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

        $datas['creator_id'] = $session_id;
    	$widget = Widget::create($datas);
    	if($widget)
    		return self::success_responses($widget);
    	else
            return self::error_responses("Unkown error");
    }

    public function show($id){
    	$widget = Widget::findOrFail($id);
    	if($widget)
    		return self::success_responses($widget);
    	else
            return self::error_responses("Unkown error");
    }

    public function update($id,Request $request){
        $datas = $request->all();

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

    	$widget = Widget::findOrFail($id);
        $widget_name = $widget->data_type;

    	$widget->update($datas);
    	if($widget){
            $res = DB::table('layout_boxes')->where('data_type',$widget_name)->update(
                ['data_type'=>$widget->name]
            );
            if($res)
    		    return self::success_responses($widget);
            else
                return self::success_responses("Update Widget Success, but no layout boxes is changed");
        }
    	else
            return self::error_responses("Unkown error");
    }

    public function destroy($id){
        $widget = Widget::findOrFail($id);
        if($widget->delete())
            return self::success_responses("success delete widget");
        else
            return self::error_responses("Unkown error");
    }
}