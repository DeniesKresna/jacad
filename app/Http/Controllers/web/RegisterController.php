<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\Controller;
use App\Notifications\Register;
use App\Models\User;
use App\Models\Role;
use App\Models\PasswordReset;

class RegisterController extends Controller {

    public function index(Request $request) {
        $validation= $this->validation($request);

        if ($validation->error) {
            return json_encode(to_object([
                'status_code' => 400,
                'messages' => $validation->messages
            ]));
        }

        $stored= $this->store($request->all());

        if (!$stored) {
            return json_encode(to_object([
                'status_code' => 500,
                'messages' => 'Store data failed'
            ]));
        } 
        
        Notification::route('mail', $stored->user->email)
                    ->notify(new Register($stored->token));

        return json_encode(to_object([
            'status_code' => 200,
            'messages' => 'Store data success',
            'data' => $stored
        ]));
    }

    private function store($fields) {
        $newUser= User::create([
            'name' => $fields['name'],
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => password_encrypt($fields['password']),
            'active' => 0
        ]);
        
        $newUser->attachRole(Role::where('name', 'customer')->first());
        $newUser->save();
        
        $token= $this->generateToken($fields['username']);
        $registerToken= PasswordReset::create([
            'email' => $fields['email'],
            'token' => $token
        ]);

        $registerToken->save();

        if (!$newUser || !$registerToken) {
            return null;
        } 

        return to_object([
            'user' => $newUser,
            'token' => $token
        ]);
    }

    private function generateToken($username) { 
        return md5(uniqid($username, true));
    }

    public function checkToken($token) {
        $userToken= PasswordReset::where('token', $token)->first();

        if (!$userToken) {
            return to_object([
                'status_code' => '401',
                'message' => 'Unauthorized'
            ]);
        }

        $user= User::where('email', $userToken->email)->first();
        $user->active= 1;
        
        $user->save();

        /*return json_encode(to_object([
            'status_code' => 200,
            'message' => 'Verify success'
        ]));*/
        
        echo '<script>';
        echo    'alert("Verify success!");';
        echo    'window.location.href= "'.url('/').'";';
        echo '</script>';
    }   

    private function validation($request) {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:200|unique:users',
            'phone' => 'required|string|max:30',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|max:100|confirmed',
            'password_confirmation' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return to_object([
                'error' => true, 
                'messages' => $validator->errors()
            ]);
        }

        return to_object([
            'error' => false
        ]);
    }
}
