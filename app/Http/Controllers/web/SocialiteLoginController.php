<?php

namespace App\Http\Controllers\web;

use Socialite;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class SocialiteLoginController extends Controller {
    
    public function redirectToProvider($provider) {
        
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider) {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            dd($e);
        }
        
        $existingUser= User::where('email', $user->email)->first();
        
        if (!$existingUser) {
            $user= User::create([
                'name' => $user->name,
                'username' => '',
                'email' => $user->email,
                'password' => password_encrypt($user->email),
                'phone' => '',
                'active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            $user->save();
        } else {
            $user= $existingUser;
        }
        
        if (Auth::guard('user')->attempt(['username' => $user->username, 'password' => $user->password])) {
            return redirect('/');
        } else {
            dd('error');
        }
    }
}
