<?php 

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Job;

class JobController extends ApiController {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {   
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $datas = Job::where('id', '>', 0);
        
        if ($request->has('search')) {
            $datas = $datas->where('position','like',"%".$search."%");
        }

        $datas = $datas->orderBy('id', 'desc')->paginate($page_size);
        
        return response()->json($datas);
    }
    
    public function show($job_id) {
        $job= Job::where(['id' => $job_id])->first();
        
        $job->type= strtoupper($job->type);
        $job->posted_at= time_elapsed_string(strval($job->created_at));

        //IF LOCATION SEMENTARA
        if ($job->location_id == 1) $job->location= 'Jakarta';
        else if ($job->location_id == 2) $job->location= 'Surabaya';
        else if ($job->location_id == 3) $job->location= 'Yogyakarta';
        
        return response()->json([
            'job' => $job,
            'company' => $job->company
        ]);
    }
}