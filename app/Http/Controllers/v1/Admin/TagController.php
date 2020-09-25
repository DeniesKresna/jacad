<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ApiController;
use App\Models\Tag;

use Validator;

class TagController extends ApiController
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
        $datas = Tag::where('id','>',0);
        
        if ($request->has('search')) {
            $datas = $datas->where('name','like',"%".$search."%");
        }

        $datas = $datas->with(['updater'=>function($query) use ($search){
            $query->orWhere('name','like',"%".$search."%");
        }]);

        $datas = $datas->orderBy("id","desc")->paginate($page_size);

        return response()->json($datas);
    }

    public function list(Request $request){
        return response()->json(Tag::orderBy('name')->get());
    }

    public function store(Request $request) {
        $req = $request->all();
        //$session_id = $request->get('auth')->user->id;
        $session_id = Session::get('user') ? Session::get('user')->id : 1;
        $datas["updater_id"] = $session_id;
        $validator = Validator::make($req, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) 
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages()
            ], 422);
        
        $category = Tag::create($req);
        
        if ($category)
            return response()->json([
                'data' => $category, 
                'message' => 'category created'
            ]);
        else
            return response()->json([
                "message" => "cant create category"
            ], 400);
    }
}

