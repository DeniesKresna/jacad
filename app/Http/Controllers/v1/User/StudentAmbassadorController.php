<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\StudentAmbassador;

use Validator;

class StudentAmbassadorController extends ApiController {
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {

    }

    public function store(Request $request) {
        $datas= $request->all();
        
        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'fail' => false, 
                'message' => $validator->messages(),
            ], 422);
        }

        $jsa= StudentAmbassador::create($datas);
        
        if ($jsa) {
            return response()->json([
                'data' => [
                    'jsa' => $jsa
                ], 
                'message' => 'jsa created'
            ], 200);
        } else {
            return response()->json([
                'message' => 'cant create jsa'
            ], 400);
        }
    }
}
