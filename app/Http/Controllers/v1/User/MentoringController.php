<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Mentoring;

use Validator;

class MentoringController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $datas= $request->all();    
        $datas['creator_id']= 1;

        $validator = Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([ 'message' => $validator->messages()], 422);
        }
        
        $mentoring= Mentoring::create($datas);
        $mentoring->creator()->update($datas);
        $mentoring->save();

        if ($mentoring) {
            return response()->json(['message' => 'mentoring created']);
        } else {
            return response()->json(['message' => 'mentoring created'], 400);
        }
    }
}
