<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Layout;
use App\Models\LayoutBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LayoutBoxController extends ApiController
{

    public function index(Request $request){
        $validator = Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());
        $layout_id = $request->layout_id;
        $datas = LayoutBox::with('layout', 'sequences',"sequences.content_master")->where('layout_id','=',$layout_id)->where('enable_slotting',1);
        $datas = $datas->orderBy("id","desc")->get();
        return self::success_responses($datas);
    }

    public function show($id){
        $layout_box = LayoutBox::findOrFail($id);
        if ($layout_box)
            return self::success_responses($layout_box->load('layout','sequences', 'sequences.content_master'));
        else
            return self::error_responses("Unkown error");
    }

    public function store(Request $request){
        $session_id = $request->get('auth')->user->id;
        $validator = Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());
        $datas = $request->all();
        $datas['creator_id'] = $session_id;

        $res = LayoutBox::create($datas);
        if($res){
            return self::success_responses($res->load('layout','sequences'));
        } else{
            return self::error_responses("Unknown Error");
        }
    }

    public function update( Request $request ,$id){
        $layout_box = LayoutBox::findOrFail($id);
        if ($layout_box) {
            $layout_box->update($request->all());
            return self::success_responses($layout_box->load('layout','sequences'));
        } else {
            return self::error_responses("Unkown error");
        }
    }

    public function destroy($id){
        $res = LayoutBox::findOrFail($id);
        $res->sequences()->delete();
        $res->delete();
        return self::success_responses("Success delete Layout");
    }
}