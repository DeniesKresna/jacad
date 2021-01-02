<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use App\Http\Controllers\ApiController;
use App\Notifications\UserVerification;
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

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terdapat kesalahan dalam isian, silahkan coba kembali.',
                'errors' => $validator->messages()
            ], 422);
        }   

        $datas['password']= password_encrypt($datas['password']);
        $datas['active']= 0;
        
        $newUser= User::create($datas); 
        $newUser->roles(Role::where('name', 'customer')->first()->id);
        $newUser->save();

        if (!$newUser) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.'], 400);
        }

        $token= $this->generateToken($datas['username']);

        $registerToken= PasswordReset::create(['email' => $datas['email'], 'token' => $token]);
        $registerToken->save();
        
        if (!$registerToken) {
            return response()->json(['message' => 'Terjadi kendala, silahkan hubungi Customer Service.'], 400);
        }   

        $response= null;

        Notification::route('mail', $newUser->email)
                    ->notify(new UserVerification($token));
        $response= response()->json(['message' => 'Maaf, untuk verifikasi akun sementara masih belum bisa, silahkan lanjut untuk login.'], 401);

        return $response;

        try {
            Notification::route('mail', $newUser->email)
                        ->notify(new UserVerification($token));
            
            $response= response()->json(['message' => 'Cek email anda untuk verifikasi akun.']);
        } catch (\Throwable $th) {
            $newUser->active= 1;
            $newUser->save();
            
            $response= response()->json(['message' => 'Maaf, untuk verifikasi akun sementara masih belum bisa, silahkan lanjut untuk login.'], 401);
        }

        return $response;
    }

    private function generateToken($username) { 
        return md5(uniqid($username, true));
    }
    
    public function checkToken($token) {
        $userToken= PasswordReset::where('token', $token)->first();

        if (!$userToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
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

