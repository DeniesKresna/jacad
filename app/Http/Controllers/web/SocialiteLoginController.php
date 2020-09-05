<?php

namespace App\Http\Controllers\web;

use Socialite;

use Illuminate\Support\Facades\Session;

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
                'password' => '',
                'phone' => '',
                'active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        } else {
            $user= $existingUser;
        }

        Session::put('user', $user);

        return redirect('/');
    }
}
