<?php

namespace App\Http\Controllers\web;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Hash;
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
                'email' => $user->email,
                'active' => 1
            ]);
            
            $user->save();
        } else {
            $user= $existingUser;
        }
        
        if (Auth::login($user, true)) {
            return redirect('/');
        } else {
            dd('error');
        }
    }
}
