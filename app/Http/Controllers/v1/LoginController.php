<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ApiController;

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

        //$datas['password']= password_encrypt($datas['password']);
        //$user= User::where($datas)->orWhere(['email'=>$datas['username'], 'password'=>$datas['password']])->first();    

        if (!Auth::guard('user')->attempt($datas)) {
            return response()->json([
                'data' => $datas, 
                'messages' => 'Wrong username or password'
            ], 404);
        }

        return response()->json([
            'user' => Auth::user()
        ], 200);
    }
}

