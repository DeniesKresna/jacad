<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\Register;
use App\Models\User;
use App\Models\Role;
use App\Models\PasswordReset;

use Validator;

class RegisterController extends ApiController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $datas= $request->all();

        $validate= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validate->fails()) {
            return response()->json([
                'data' => $datas, 
                'messages' => $validate->messages()
            ], 422);
        }

        $datas['password']= password_encrypt($datas['password']);
        $datas['active']= 0;
        
        $newUser= User::create($datas);

        $newUser->attachRole(Role::where('name', 'customer')->first());
        $newUser->save();

        $token= $this->generateToken($datas['username']);
        $registerToken= PasswordReset::create([
            'email' => $datas['email'],
            'token' => $token
        ]);

        $registerToken->save();
        
        if ($newUser && $registerToken) {
            Notification::route('mail', $newUser->email)
                        ->notify(new Register($token));

            return response()->json([
                'newUser' => $newUser
            ], 200);
        }
    }

    private function generateToken($username) { 
        return md5(uniqid($username, true));
    }
    
    public function checkToken($token) {
        $userToken= PasswordReset::where('token', $token)->first();

        if (!$userToken) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user= User::where('email', $userToken->email)->first();
        $user->active= 1;
        
        $user->save();
        
        echo '<script>';
        echo    'window.location.href= "'.url('/').'";';
        echo    'alert("Succes verified!");';
        /*echo    'swal({';
        echo        'title: "Verification success!", ';
        echo        'text: "Your account has been succesfully verified",';
        echo        'icon: "success"';
        echo    '});';*/
        echo '</script>';
    }
}

