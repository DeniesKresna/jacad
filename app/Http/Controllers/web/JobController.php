<?php

namespace App\Http\Controllers\web;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class JobController extends Controller
{
    //
    public function index()
    {
        return view('job.show');
    }

    public function create(){
    	return view('job.create',['title'=>"Post Job"]);
    }
}
