<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\User;

use Validator;

class LoginController extends ApiController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $datas = $request->all();

        $validate= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validate->fails()) {
            return response()->json([
                'data' => $datas, 
                'messages' => $validate->messages()
            ], 422);
        }

        $datas['password']= password_encrypt($datas['password']);
        $user= User::where($datas)->first();    
        
        if (!$user) {
            return response()->json([
                'data' => $datas, 
                'messages' => 'Wrong username or password'
            ], 404);
        }
        
        return response()->json([
            'user' => $user
        ], 200);
    }
}

