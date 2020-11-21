<?php

namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ApiController;
use App\Models\Job;

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
        $job= Job::with(['company', 'location'])->findOrFail($id);

        return response()->json($job);
    }

    public function update(Request $request, $id) {
        $datas = $request->all();
        $datas['verificator_id'] = 1;
        
        $status= 'rejected';

        if ($request->verify == 'yes'){
            $datas['verified'] = 1;
            $status= 'verified';
        } else {
            $datas['verified'] = 2;
        }

        $job = Job::findOrFail($id);
        $job->update($datas);
        $job->save();

        if ($job) {
            return response()->json(['message' => 'job '.$status]);
        } else {
            return response()->json(['message' => 'cant verify job'], 400);
        }
    }

    public function destroy(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->delete();
        
        return response()->json(['message' => 'job deleted']);
    }
}
