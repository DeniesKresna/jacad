<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

class LogoutController extends Controller {

    public function index() {
        Session::forget('user');

        return redirect('/');
    }
}
