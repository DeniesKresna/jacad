<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

    public function index(Request $request) {
        $validation = $this->validation($request);

        if ($validation->error) {
            return json_encode(to_object([
                'status_code' => 400,
                'messages' => $validation->messages
            ]));
        }

        $user= User::where([
            'username' => $request->username,
            'password' => password_encrypt($request->password)
        ])->first();

        if (!$user) {
            return json_encode(to_object([
                'status_code' => 404,
                'messages' => 'Wrong username or password!'
            ]));
        }   
        
        //$user->name= explode(' ', $user->name)[0].' '.strtoupper(explode(' ', $user->name)[1]);

        Session::put('user', $user);

        return json_encode(to_object([
            'status_code' => 200,
            'messages' => 'Login success!'
        ]));
    }

    public function validation($request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:200',
            'password' => 'required|string|min:6|max:100',
        ]);

        if ($validator->fails()){
            return to_object(["error" => true, "messages" => $validator->errors()]);
        } else {
            return to_object(["error" => false]);
        }
    }
}
