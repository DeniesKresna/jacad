<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

class SessionController extends Controller {
    
    public function store(Request $request) {
        Session::put('user', to_object($request->all()));

        echo json_encode(Session::get('user'));
    }
    
    public function destroy() {
        Session::forget('user');

        return redirect('/');
    }
}
