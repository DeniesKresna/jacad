<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Company;
use App\Models\Sector;
use App\Models\Location;

class JobController extends Controller 
{
    public function index(Request $request) {
        $page_size = $request->page ? $request->page_size : 10;
        $jobs= Job::where('id', '>', 0)->where('verified', 1);
        $locations= Location::all();

        if ($request->has('position')) {
            $jobs= $jobs->where('position', 'like', '%'.$request->position.'%');
        }   
        
        if ($request->has('location_id') && $request->location_id != 'all') {
            $jobs= $jobs->whereHas('location', function($query) use ($request) {
                $query->where('id', $request->location_id);
            });
        }

        $jobs= $jobs->with(['company', 'location'])->paginate($page_size);

        return view('pages.job.list', [
            'jobs' => $jobs,
            'locations' => $locations
        ]);
    }

    public function show($id) {
        $job= Job::with(['company', 'location'])->findOrFail($id);
        $job->type= strtoupper($job->type);
        $job->posted_at= time_elapsed_string(strval($job->created_at));

        return view('pages.job.show', ['job' => $job]);
    }

    public function create() {
        $companies = Company::limit(10)->get();
        $sectors= Sector::all();
        $locations= Location::all();

    	return view('pages.job.create', [
            'title' => 'Post Job', 
            'companies' => $companies,
            'sectors' => $sectors,
            'locations' => $locations
        ]);
    }
}
