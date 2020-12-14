<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ApiController;

class JobApplicationController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function index(Request $request) {
        $page_size = $request->page_size;
        $search= $request->search;

        $job_applications= DB::table('jobs')
            ->join('companies', 'companies.id', 'jobs.creator_id')
            ->join('job_applications', 'job_applications.job_id', 'jobs.id')
            ->join('users', 'users.id', 'job_applications.applicant_id')
            ->when($request->search && $search, function($query) use ($search) {
                $query->where('jobs.position', 'like', '%'.$search.'%')
                    ->orWhere('companies.name', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '%'.$search.'%');
            })->select(
                'jobs.id as job_id',
                'jobs.position as job_position',
                'companies.name as company_name',
                'users.id as applicant_id',
                'users.name as applicant_name'
            )->orderBy('job_applications.id', 'desc')
            ->paginate($page_size);
        
        return response()->json($job_applications);
    }
}
