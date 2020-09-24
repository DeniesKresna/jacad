<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class TestController extends ApiController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function adi(Request $request)
    {
        $user = DB::table('users')->insert([
            [
                'name'=>"Penjual Hebat",
                'email'=>"sales.smartit@gmail.com",
                'phone'=>"08157006008",
                'username'=>"sales",
                'password'=>password_encrypt("sales123!!!"),
                'active'=>1,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]]);
        return response()->json($user);
    }
}

