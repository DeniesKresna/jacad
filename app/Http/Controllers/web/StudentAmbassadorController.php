<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class StudentAmbassadorController extends Controller {

    public function index() {
        return view('pages.student-ambassador.opening', ['title' => 'Jobhun Student Ambassador']);
    }
}
