<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Layout;
use App\Models\LayoutBox;
use App\Models\LayoutSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LayoutSequenceController extends ApiController
{

    /**
     * Accessing Location Data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $validator = Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());

        $layout_box_id = $request->layout_box_id;
        $datas = LayoutSequence::with('layoutBox', 'content')->where('layout_box_id','=',$layout_box_id);
        $datas = $datas->orderBy("id","desc")->get();
        return self::success_responses($datas);
    }

    public function show($id){
        $layout = LayoutSequence::findOrFail($id);
        if ($layout)
            return self::success_responses($layout->load('layoutBox','content'));
        else
            return self::error_responses("Unkown error");
    }

    public function store(Request $request){
        $session_id = $request->get('auth')->user->id;
        $validator = Validator::make($request->all(), rules_lists(__CLASS__, __FUNCTION__));
        if($validator->fails()) return self::error_responses($validator->messages());
        $datas = $request->all();
        $datas['creator_id'] = $session_id;

        $res = LayoutSequence::create($datas);
        if($res){
            return self::success_responses($res->load('layoutBox','content'));
        } else{
            return self::error_responses("Unknown Error");
        }
    }

    public function destroy($id){
        $res = LayoutSequence::findOrFail($id);
        $res->delete();
        return self::success_responses("Success delete Layout");
    }
}