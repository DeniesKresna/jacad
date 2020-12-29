<?php

namespace App\Http\Controllers\v1\User;

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

        $validator= Validator::make($datas, rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terdapat kesalahan dalam isian, silahkan coba kembali.',
                'errors' => $validator->messages()
            ], 422);
        }
        
        $user= User::where('username', $datas['username'])->first();

        if (!$user) {
            return response()->json(['message' => 'Nama pengguna anda salah.'], 404);
        }

        if (!Hash::check($datas['password'], $user->password)) {
            return response()->json(['message' => 'Kata sandi anda salah.'], 404);
        }

        if ($user->active == 0) {
            return response()->json(['message' => 'Verifikasi akun anda terlebih dahulu.'], 401);
        }

        Auth::login($user, true);

        return response()->json([
            'message' => "Selamat datang, {$user->name}!",
            'base_url' => url('/')
        ]);
    }
}

