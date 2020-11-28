<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\User;

class UserController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $user= User::with('profile')->findOrFail($id);

        return response()->json($user);
    }
}
