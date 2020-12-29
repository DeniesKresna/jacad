<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ApiController;
use App\Models\Job;
use App\Models\Company;

class JobController extends ApiController 
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;

        $jobs= Job::with('company')->when($request->has('search') && $request->search, function($query) use($search) {
                $query->where('position', 'like', '%'.$search.'%')
                    ->orWhereHas('company', function($query) use ($search) {
                            $query->where('name', 'like', '%'.$search.'%');
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate($page_size);

        return response()->json($jobs);
    }
    
    public function show($id) {
        $job= Job::with(['company', 'sectors', 'location'])->findOrFail($id);

        return response()->json($job);
    }

    public function update(Request $request, $id) {
        $datas = $request->all();
        $datas['company']= json_decode($request->company, true);
        $datas['job']= json_decode($request->job, true);

        $validator = Validator::make(array_merge($datas['company'], $datas['job']), rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        if ($request->hasFile('company_logo') && $request->file('company_logo')) {
            $upload= upload('/screen/medias/logos/', $request->file('company_logo'), '1');
        
            $datas['company']['logo_path']= $upload;
            $datas['company']['logo_url']= upload_dir().$upload;
        }
        
        $company= Company::findOrFail($datas['company']['id']);
        $company->update($datas['company']);

        if (!$company->save()) {
            return response()->json(['message' => 'Update company failed'], 500);
        }

        $job = Job::findOrFail($id);
        $job->update($datas['job']);
        $job->sectors()->sync($datas['job']['sectors']);
        $job->location()->associate($datas['job']['location']);

        if (!$job->save()) {
            return response()->json(['message' => 'Update job failed'], 500);
        }

        return response()->json(['message' => "Job {$job->position} updated!"]);
    }

    public function destroy(Request $request, $id) {
        $job = Job::findOrFail($id);
        
        if ($request->has('hard')) {
            if (filter_var(request()->hard, FILTER_VALIDATE_BOOLEAN)) {
                $job->forceDelete();
                
                return response()->json(['message' => "Job {$job->position} permanently deleted!"]);
            }
        }

        $job->sectors()->detach();
        $job->delete();

        if (!$job->save()) {
            return response()->json(['message' => 'Delete job failed']);
        }
        
        return response()->json(['message' => "Job {$job->position} deleted!"]);
    }

    public function verify(Request $request, $id) {
        $job = Job::findOrFail($id);

        if (!$request->action) {
            return response()->json(['message' => 'Request not found'], 400);
        }
        
        if ($request->action == 'accept') {
            $job->verified= 1;
        } else if ($request->action == 'reject') {
            $job->verified= 2;
        }

        $job->verificator_id= 1;

        if (!$job->save()) {
            return response()->json(['message' => 'Verify job failed'], 500);
        }

        return response()->json(['message' => "Job {$job->position} {$request->action}ed!"]);
    }

    public function getApplicants(Request $request) {
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
            })
            ->select(
                'jobs.id as job_id',
                'jobs.position as job_position',
                'companies.name as company_name',
                'users.id as applicant_id',
                'users.name as applicant_name'
            )
            ->orderBy('job_applications.id', 'DESC')
            ->paginate($page_size);
        
        return response()->json($job_applications);
    }
}
