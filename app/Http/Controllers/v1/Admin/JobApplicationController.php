<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Job;

class JobApplicationController extends ApiController
{
    public function index(Request $request) {
        $page_size = $request->page_size;
        $job_applications= Job::where('id', '>', 0);

        if ($request->has('search') && $request->search) {
            $search= $request->search;
            $callback_search_applicants= function($query) use ($search) {
                $query->where('users.name', 'like', '%'.$search.'%');
            };
            
            if ($job_applications->position($search)->count() > 0) {
                $job_applications= $job_applications
                ->has('applicants')
                ->with(['company', 'applicants'])
                ->paginate($page_size);

                return response()->json($job_applications);
            }

            if ($job_applications->orWhereHas('company', function($query) use ($search) {
                $query->where('companies.name', 'like', '%'.$search.'%');
            })->count() > 0) {
                $job_applications= $job_applications
                ->has('applicants')
                ->with(['company', 'applicants'])
                ->paginate($page_size);

                return response()->json($job_applications);
            }

            if ($job_applications->orWhereHas('applicants', function($query) use ($search) {
                $query->where('users.name', 'like', '%'.$search.'%');
            })->count() > 0) {
                $job_applications= $job_applications
                ->has('applicants')
                ->with([
                    'company', 
                    'applicants' => $callback_search_applicants
                ])->paginate($page_size);

                return response()->json($job_applications);
            }
        }
        
        $job_applications= $job_applications
            ->has('applicants')
            ->with(['company', 'applicants'])
            ->paginate($page_size);

        return response()->json($job_applications);
    }
}
