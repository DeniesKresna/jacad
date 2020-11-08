<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Company;
use App\Models\Sector;

class JobController extends Controller 
{
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $page ? $request->page_size : 10;
        $jobs= Job::all();

        foreach ($jobs as $key => $job) { //IF LOCATION SEMENTARA
            if ($job->location_id == 1) $job->location= 'Jakarta';
            else if ($job->location_id == 2) $job->location= 'Surabaya';
            else if ($job->location_id == 3) $job->location= 'Yogyakarta'; 
        }

        return view('pages.job.list', ['jobs' => $jobs]);
    }

    public function show($id) {
        $job= Job::findOrFail($id);
        
        $job->type= strtoupper($job->type);
        $job->posted_at= time_elapsed_string(strval($job->created_at));

        //IF LOCATION SEMENTARA
        if ($job->location_id == 1) $job->location= 'Jakarta';
        else if ($job->location_id == 2) $job->location= 'Surabaya';
        else if ($job->location_id == 3) $job->location= 'Yogyakarta';

        return view('pages.job.show', ['job' => $job]);
    }

    public function create() {
        $companies = Company::limit(10)->get();
        $sectors= Sector::all();

    	return view('pages.job.create', [
            'title' => 'Post Job', 
            'companies' => $companies,
            'sectors' => $sectors
        ]);
    }
}
