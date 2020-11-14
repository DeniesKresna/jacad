<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\User;

class UserController extends ApiController
{
    public function show($id) {
        $user= User::with('profile')->findOrFail($id);

        return response()->json($user);
    }
}
