<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class JobController extends ApiController {
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
        $datas = Job::where('id','>',0);
        if($request->has('search')){
            $datas = $datas->where('position','like',"%".$search."%")
                        ->orWhereHas('company',function($query) use($search){
                            $query->where('name','like','%'.$search.'%');
                        });
        }

        $datas = $datas->orderBy("id","desc")->paginate($page_size);
        return response()->json($datas);
    }

    public function show($id){
        return response()->json(Job::findOrFail($id)->load(['categories']));
    }

    public function update(Request $request, $id){
        $datas = $request->all();
        //$session_id = $request->get('auth')->user->id;
        //$datas["customer_id"] = $session_id;
        $datas["verificator_id"] = 1;
        $res = "rejected";
        if($request->verified == "y"){
            $datas["verified"] = 1;
            $res = "accepted";
        }
        else{
            $datas["verified"] = 2;
        }
        $job = Job::findOrFail($id);
        if($job){
            DB::table("jobs")->where('id',$job->id)->update($datas);
            return response()->json(['message'=>'job '.$res]);
        }
        else
            return response()->json(["message"=>"cant verify job"],400);
    }

    public function destroy(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->delete();
        return response()->json(['data'=>$job,'message'=>'post deleted']);
    }
/*
    public function index(Request $request) {   
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $datas = Job::where('id', '>', 0);
        
        if ($request->has('search')) {
            $datas = $datas->where('position','like',"%".$search."%");
        }

        $datas = $datas->orderBy('id', 'desc')->paginate($page_size);
        
        return response()->json($datas);
    }*/
}
