<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\Register;
use App\Models\User;
use App\Models\Role;
use App\Models\PasswordReset;

class RegisterController extends ApiController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $datas= $request->all();

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'name.required' => 'Kolom nama harus diisi',
            'username.required' => 'Kolom nama pengguna harus diisi',
            'password.required' => 'Kolom kata sandi harus diisi',
            'password_confirmation.required' => 'Kolom konfirmasi kata sandi harus diisi',
            'email.required' => 'Kolom email harus diisi',
            'phone.required' => 'Kolom nomor handhpone harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json(['fields' => $validator->messages()], 422);
        }

        $datas['password']= password_encrypt($datas['password']);
        $datas['active']= 0;
        
        $newUser= User::create($datas);
        $newUser->attachRole(Role::where('name', 'customer')->first());
        $newUser->save();

        $token= $this->generate_token($datas['username']);

        $registerToken= PasswordReset::create([
            'email' => $datas['email'],
            'token' => $token
        ]);
        $registerToken->save();
        
        if ($newUser && $registerToken) {
            Notification::route('mail', $newUser->email)
                        ->notify(new Register($token));
            
            return response()->json(['messages' => 'Berhasil daftar! Cek email anda untuk verifikasi akun']);
        } else {
            return response()->json(['messages' => 'Terjadi kendala, silahkan hubungi Customer Service kami'], 400);
        }
    }

    private function generate_token($username) { 
        return md5(uniqid($username, true));
    }
    
    public function check_token($token) {
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
        echo '</script>';
    }
}

