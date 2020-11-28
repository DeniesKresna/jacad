<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\AskCareer;

use Validator;

class AskCareerController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search= $request->search;
        $ask_careers= AskCareer::when($request->has('search') && $request->search, function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhereHas('mentor', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
        })->with('mentor')
        ->orderBy('id', 'desc')
        ->paginate($page_size);
        
        return response()->json($ask_careers);
    }

    public function show($id) {
        $ask_career= AskCareer::with('mentor')->findOrFail($id);

        return response()->json($ask_career);
    }

    public function store(Request $request) {
        $datas= $request->all();
        $datas['creator_id']= 1;
        
        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $ask_career= AskCareer::create($datas);
        $ask_career->mentor()->associate($datas['mentor']);
        $ask_career->save();

        if ($ask_career) {  
            return response()->json(['message' => 'ask career created']);
        } else {
            return response()->json(['message' => 'cant create ask career']);
        }
    }

    public function update(Request $request, $id) {
        $datas= $request->all();
        $datas['updater_id']= 1;    

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        $ask_career= AskCareer::findOrFail($id);
        $ask_career->update($datas);
        $ask_career->mentor()->associate($datas['mentor']);
        $ask_career->save();

        if ($ask_career) {  
            return response()->json(['message' => 'ask career updated']);
        } else {
            return response()->json(['message' => 'cant update ask career']);
        }
    }

    public function destroy(Request $request, $id) {
        $ask_career= AskCareer::findOrFail($id);
        
        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                $ask_career->forceDelete();
                
                return response()->json(['message' => 'blog deleted']);
            }
        }
        
        $ask_career->delete();
        $ask_career->save();

        return response()->json(['message' => 'blog deleted']);
    }
}
