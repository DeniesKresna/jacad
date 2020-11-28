<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Job;
use App\Models\Company;

use Validator;

class JobController extends ApiController {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $page = $request->page;
        $page_size = $request->page_size;
        $search = $request->search;
        $datas = Job::where('id', '>', 0);
        
        if ($request->has('search')) {
            $datas = $datas
                ->where('position', 'like', "%".$search."%")
                ->orWhereHas('company', function($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        }
        
        $datas = $datas->with('company')->orderBy('id', 'desc')->paginate($page_size);

        return response()->json($datas);
    }
    
    public function show($id) {
        $job= Job::with(['company', 'sectors', 'location'])->findOrFail($id);

        return response()->json($job);
    }

    public function update(Request $request, $id) {
        $datas = $request->all();
        $datas['company']= json_decode($request->company, true);
        $datas['job']= json_decode($request->job, true);

        $job = Job::findOrFail($id);

        if ($request->has('verify') && $request->verify) {
            $datas['job']['verificator_id'] = 1;
            $status= 'rejected';

            if ($request->verify == 'yes') {
                $datas['verified'] = 1;
                $status= 'verified';
            } else {
                $datas['verified'] = 2;
            }

            $job->verified= $datas['verified'];
            $job->save();   
            
            if ($job) {
                return response()->json(['message' => 'job '.$status]);
            } else {
                return response()->json(['message' => 'cant verify job'], 400);
            }

            return response()->json($job);
        }

        $validator = Validator::make(array_merge($datas['company'], $datas['job']), rules_lists(__CLASS__, __FUNCTION__));
        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        if ($request->hasFile('company_logo')) {
            $upload = upload('/screen/medias/logos/', $request->file('company_logo'), '1');
        
            $datas['company']['logo_path'] = $upload;
            $datas['company']['logo_url'] = upload_dir().$upload;
        }

        $company= Company::findOrFail($datas['company']['id']);
        $company->update($datas['company']);
        $company->save();

        $job->update($datas['job']);
        $job->sectors()->sync($datas['job']['sectors']);
        $job->location()->associate($datas['job']['location']);
        $job->save();

        if ($job && $company) {
            return response()->json(['message' => 'job updated']);
        } else {
            return response()->json(['message' => 'cant update job'], 400);
        }
    }

    public function destroy(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->delete();
        
        return response()->json(['message' => 'job deleted']);
    }
}
