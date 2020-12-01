<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\User;

class LoginController extends ApiController {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $datas = $request->all();

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__), [
            'username.required' => 'Kolom nama pengguna harus diisi',
            'password.required' => 'Kolom kata sandi harus diisi'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['fields' => $validator->messages()], 422);
        }
        
        $user= User::where('username', $datas['username'])->firstOrFail();

        if (!$user) {
            return response()->json(['messages' => 'Nama pengguna salah'], 404);
        }

        if (!Hash::check($datas['password'], $user->password)) {
            return response()->json(['messages' => 'Kata sandi salah'], 404);
        }

        Auth::login($user, true);

        return response()->json([
            'messages' => 'Berhasil masuk!',
            'redirect_to' => url('/')
        ]);
    }
}

