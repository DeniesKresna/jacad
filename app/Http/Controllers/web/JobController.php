<?php

namespace App\Http\Controllers\web;

use App\Models\Job;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class JobController extends Controller {

    public function index(Request $request) {
        $page = $request->page;
        $page_size = $page ? $request->page_size : 10;
        
        //DUMMY DATA SEMENTARA
        $jobs= [
            to_object([
                'position' => 'Web Developer',
                'company' => 'Company 1',
                'location' => 'City 1'
            ]),
            to_object([
                'position' => 'Web Designer',
                'company' => 'Company 2',
                'location' => 'City 2'
            ]),
            to_object([
                'position' => 'Graphic Designer',
                'company' => 'Company 3',
                'location' => 'City 3'
            ]),
            to_object([
                'position' => 'Graphic Designer',
                'company' => 'Company 4',
                'location' => 'City 4'
            ]),
            to_object([
                'position' => 'UI/UX Designer',
                'company' => 'Company 5',
                'location' => 'City 5'
            ]),
            to_object([
                'position' => 'Android Developer',
                'company' => 'Company 6',
                'location' => 'City 6'
            ]),
        ];

        return view('job.list', ['jobs' => $jobs]);
    }

    public function show($job_id) {

        return view('job.show');
    }

    public function create() {
        $companies = Company::limit(10)->get();
    	return view('job.create',['title' => 'Post Job', 'companies'=>$companies]);
    }

    public function store(){
        
    }
}
